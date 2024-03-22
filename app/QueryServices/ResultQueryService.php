<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\Result;
use App\Models\AnswerQuestion;
use App\Models\AnswerStudent;
use Illuminate\Database\Query\Builder;

class ResultQueryService extends QueryService
{
    protected Result $result;
    protected AnswerQuestion $answerQuestion;
    protected AnswerStudent $answerStudent;

    function __construct()
    {
        $this->result = new Result;
        $this->answerQuestion = new AnswerQuestion;
        $this->answerStudent = new AnswerStudent;
    }

    function get()
    {
        $results = $this->result->select([
            'r.id as id',
            'r.title as title',
            'r.created_at as created_at'
        ])
            ->selectRaw('COUNT(aq.id) as questions_count')
            ->selectRaw('SUM(CASE WHEN aq.is_dummy = 1 THEN 1 ELSE 0 END) as dummy_count')
            ->selectRaw('COUNT(aq.id) - SUM(CASE WHEN aq.is_dummy = 1 THEN 1 ELSE 0 END) as true_questions_count')
            ->from('results as r')
            ->leftJoin('answer_questions as aq', 'r.id', '=', 'aq.result_id')
            ->groupBy('r.id')
            ->get();
        foreach ($results as $key => $result) {
            $results[$key]['failed_questions_count'] = $this->result
                ->from('answer_questions as aq')
                ->where('result_id', $result->id)
                ->whereNull('question_id')
                ->count();
        }
        foreach ($results as $key => $result) {
            $results[$key]['failed_answers_count'] = $this->result
                ->from('answers as a')
                ->where('result_id', $result->id)
                ->whereNull('answer_num')
                ->count();
        }
        foreach ($results as $key => $result) {
            $results[$key]['students_count'] = $this->result
                ->from('answer_students as as')
                ->where('result_id', $result->id)
                ->count();
        }
        foreach ($results as $key => $result) {
            $results[$key]['result_summary'] = $this->answerStudent
                ->selectRaw('AVG(correct_rate) as avg')
                ->selectRaw('MAX(correct_rate) as max_score')
                ->selectRaw('MIN(correct_rate) as min_score')
                ->selectRaw('100 * SUM(CASE WHEN is_passed = 1 THEN 1 ELSE 0 END)/COUNT(code) as passed_rate')
                ->selectRaw('STDDEV_POP(correct_rate) as stddev')
                ->from('answer_students as as')
                ->fromSub(
                    function (Builder $query) use ($result) {
                        $query
                            ->select(['as.code'])
                            ->selectRaw('MAX(is_passed) as is_passed')
                            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
                            ->from('answer_students as as')
                            ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
                            ->leftJoin('answer_questions as aq', function ($join) {
                                $join->on('aq.id', '=', 'a.question_id');
                            })
                            ->where('aq.is_dummy', "!=", "1")
                            ->where('as.is_dummy', "!=", "1")
                            ->where('as.result_id', $result->id)
                            ->groupBy('as.code')
                            ->orderBy('correct_rate', 'desc')
                            ->get();
                    }, 'ss')
                ->first();
        }
        return $results;
    }

    function getQuestionData($resultId)
    {
        $questions = $this->answerQuestion
            ->select(
                [
                    'aq.id as id',
                    'aq.text as text',
                    'aq.is_dummy as is_dummy',
                    'aq.order as order'
                ]
            )
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as correct_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 2 THEN 1 ELSE 0 END) as wrong1_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 3 THEN 1 ELSE 0 END) as wrong2_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 4 THEN 1 ELSE 0 END) as wrong3_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num IS NULL THEN 1 ELSE 0 END) as na_count')
            ->from('answer_questions as aq')
            ->leftJoin('answers as a', 'aq.id', '=', 'a.question_id')
            ->where('aq.result_id', $resultId)
            ->groupBy('aq.id')
            ->orderBy('aq.order')
            ->get();
        return $questions;
    }

    function getStudentData($resultId)
    {
        $summary = $this->answerStudent
            ->selectRaw('AVG(correct_rate) as avg')
            ->selectRaw('STDDEV_POP(correct_rate) as stddev')
            ->selectRaw('MAX(correct_rate) as max_score')
            ->selectRaw('MIN(correct_rate) as min_score')
            ->selectRaw('MIN(score_passed) as min_passed_score')
            ->selectRaw('MAX(score_non_passed) as max_non_passed_score')
            ->selectRaw('100 * SUM(CASE WHEN is_passed = 1 THEN 1 ELSE 0 END)/COUNT(code) as passed_rate')
            ->from('answer_students as as')
            ->fromSub(
                function (Builder $query) use ($resultId){
                    $query
                        ->select(['as.code'])
                        ->selectRaw('MAX(is_passed) as is_passed')
                        ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
                        ->selectRaw('CASE WHEN MAX(is_passed) = 1 THEN 100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) ELSE 100 END as score_passed')
                        ->selectRaw('CASE WHEN MAX(is_passed) = 0 THEN 100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) ELSE 0 END as score_non_passed')
                        ->from('answer_students as as')
                        ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
                        ->leftJoin('answer_questions as aq', function ($join) {
                            $join->on('aq.id', '=', 'a.question_id');

                        })
                        ->where('aq.is_dummy', "!=", "1")
                        ->where('as.is_dummy', "!=", "1")
                        ->where('as.result_id', $resultId)
                        ->groupBy('as.code')
                        ->orderBy('correct_rate', 'desc')
                        ->get();
                }, 'ss')
            ->first();
        $students = $this->answerStudent
            ->select(
                [
                    'as.id as id',
                    'as.code as code',
                    'as.score as score',
                    'as.score_count as score_count',
                    'as.is_passed as is_passed',
                    'as.is_dummy as is_dummy'
                ]
            )
            ->selectRaw('COUNT(a.question_id) as questions_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as answers_score')
            ->selectRaw('SUM(CASE WHEN a.answer_num IS NOT NULL AND a.answer_num != 1 THEN 1 ELSE 0 END) as answers_wrong_score')
            ->selectRaw('SUM(CASE WHEN a.answer_num IS NULL THEN 1 ELSE 0 END) as answers_null_score')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as correct_count')
            ->selectRaw('(100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id)) - ' . $summary->avg . '/' . $summary->stddev . ' as stddevv')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
            ->selectRaw('COUNT(a.id) as answers_count')
            ->from('answer_students as as')
            ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
            ->leftJoin('answer_questions as aq', function ($join) {
                $join->on('aq.id', '=', 'a.question_id');

            })
            ->where('aq.is_dummy', "!=", "1")
            ->where('as.result_id', $resultId)
            ->groupBy('as.id')
            ->orderBy('answers_score', 'desc')
            ->get();
        return [$summary,$students];
    }

    function getQurinQuestionData()
    {
        $students = $this->answerQuestion
            ->select(
                [
                    'q.id as id',
                    'q.text as text'
                ]
            )
            ->selectRaw('COUNT(a.id) as answers_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as correct_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 2 THEN 1 ELSE 0 END) as wrong1_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 2 THEN 1 ELSE 0 END)/COUNT(a.id) as wrong1_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 3 THEN 1 ELSE 0 END) as wrong2_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 3 THEN 1 ELSE 0 END)/COUNT(a.id) as wrong2_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 4 THEN 1 ELSE 0 END) as wrong3_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 4 THEN 1 ELSE 0 END)/COUNT(a.id) as wrong3_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num IS NULL THEN 1 ELSE 0 END) as na_count')
            ->from('questions as q')
            ->leftJoin('answer_questions as aq', 'q.id', '=', 'aq.question_id')
            ->leftJoin('answers as a', 'aq.id', '=', 'a.question_id')
            ->groupBy('q.id')
            ->orderBy('correct_count', 'desc')
            ->get();
        return $students;
    }

    function getQurinQuestion($questionId)
    {
        $students = $this->answerQuestion
            ->select(
                [
                    'q.id as id',
                    'q.text as text',
                    'q.correct_choice as correct_choice',
                    'q.wrong_choice_1 as wrong_choice_1',
                    'q.wrong_choice_2 as wrong_choice_2',
                    'q.wrong_choice_3 as wrong_choice_3'
                ]
            )
            ->selectRaw('COUNT(a.id) as answers_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as correct_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 2 THEN 1 ELSE 0 END) as wrong1_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 2 THEN 1 ELSE 0 END)/COUNT(a.id) as wrong1_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 3 THEN 1 ELSE 0 END) as wrong2_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 3 THEN 1 ELSE 0 END)/COUNT(a.id) as wrong2_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 4 THEN 1 ELSE 0 END) as wrong3_count')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 4 THEN 1 ELSE 0 END)/COUNT(a.id) as wrong3_rate')
            ->selectRaw('SUM(CASE WHEN a.answer_num IS NULL THEN 1 ELSE 0 END) as na_count')
            ->from('questions as q')
            ->leftJoin('answer_questions as aq', 'q.id', '=', 'aq.question_id')
            ->leftJoin('answers as a', 'aq.id', '=', 'a.question_id')
            ->where('q.id', $questionId)
            ->orderBy('correct_count', 'desc')
            ->get();
        return $students;
    }

    function getStudentResultData()
    {

        $summary = $this->answerQuestion
            ->selectRaw('AVG(correct_rate) as avg')
            ->selectRaw('STDDEV_POP(correct_rate) as stddev')
            ->from('answer_students as as')
            ->fromSub(
                function (Builder $query) {
                    $query
                        ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
                        ->from('answer_students as as')
                        ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
                        ->groupBy('as.code')
                        ->orderBy('correct_rate', 'desc')
                        ->get();
                }, 'ss')
            ->first();
        $students = $this->answerQuestion
            ->select(
                [
                    'as.code as code'
                ]
            )
            ->selectRaw('COUNT(a.id) as answers_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as correct_count')
            ->selectRaw('(100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id)) - ' . $summary->avg . '/' . $summary->stddev . ' as stddevv')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
            ->from('answer_students as as')
            ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
            ->groupBy('as.code')
            ->orderBy('correct_rate', 'desc')
            ->get();
        return $students;
    }

    function getStudentResult(int $studentId)
    {
        $summary = $this->answerQuestion
            ->selectRaw('AVG(correct_rate) as avg')
            ->selectRaw('STDDEV_POP(correct_rate) as stddev')
            ->from('answer_students as as')
            ->fromSub(
                function (Builder $query) {
                    $query
                        ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
                        ->from('answer_students as as')
                        ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
                        ->groupBy('as.code')
                        ->orderBy('correct_rate', 'desc')
                        ->get();
                }, 'ss')
            ->first();
        $student = $this->answerQuestion
            ->select(
                [
                    'as.code as code'
                ]
            )
            ->selectRaw('COUNT(a.id) as answers_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as correct_count')
            ->selectRaw('(100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id)) - ' . $summary->avg . '/' . $summary->stddev . ' as stddevv')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
            ->from('answer_students as as')
            ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
            ->where('as.id', $studentId)
            ->groupBy('as.code')
            ->orderBy('correct_rate', 'desc')
            ->get();
        return $student;
    }

    function getStudent(int $studentId,int $resultId)
    {
        $summary = $this->answerQuestion
            ->selectRaw('AVG(correct_rate) as avg')
            ->selectRaw('STDDEV_POP(correct_rate) as stddev')
            ->from('answer_students as as')
            ->fromSub(
                function (Builder $query) use ($resultId) {
                    $query
                        ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
                        ->from('answer_students as as')
                        ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
                        ->where('as.result_id', $resultId)
                        ->groupBy('as.code')
                        ->orderBy('correct_rate', 'desc')
                        ->get();
                }, 'ss')
            ->first();
        $student = $this->answerQuestion
            ->select(
                [
                    'as.code as code'
                ]
            )
            ->selectRaw('COUNT(a.id) as answers_count')
            ->selectRaw('SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END) as correct_count')
            ->selectRaw('(100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id)) - ' . $summary->avg . '/' . $summary->stddev . ' as stddevv')
            ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
            ->from('answer_students as as')
            ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
            ->where('as.id', $studentId)
            ->where('as.result_id', $resultId)
            ->groupBy('as.code')
            ->orderBy('correct_rate', 'desc')
            ->first();
        $summary = $this->answerQuestion
            ->selectRaw('AVG(correct_rate) as avg')
            ->selectRaw('STDDEV_POP(correct_rate) as stddev')
            ->from('answer_students as as')
            ->fromSub(
                function (Builder $query) use ($resultId) {
                    $query
                        ->selectRaw('100 * SUM(CASE WHEN a.answer_num = 1 THEN 1 ELSE 0 END)/COUNT(a.id) as correct_rate')
                        ->from('answer_students as as')
                        ->leftJoin('answers as a', 'as.id', '=', 'a.student_id')
                        ->where('as.result_id', $resultId)
                        ->groupBy('as.code')
                        ->orderBy('correct_rate', 'desc')
                        ->get();
                }, 'ss')
            ->first();
        $questions = $this->answerQuestion
            ->select(
                [
                    'aq.question_id as qurin_question_id',
                    'a.answer_num',
                    'a.answer_text',
                    'aq.order',
                    'aq.text',
                    'aq.is_dummy',
                ]
            )
            ->from('answer_questions as aq')
            ->leftJoin('answers as a', 'aq.id', '=', 'a.question_id')
            ->where('a.student_id', $studentId)
            ->where('aq.result_id', $resultId)
            ->orderBy('aq.order')
            ->get();
        return [$summary,$student,$questions];
    }

    function getFailedQuestionData(int $resultId)
    {

        return $this->result
            ->from('answer_questions as aq')
            ->where('result_id', $resultId)
            ->whereNull('question_id')
            ->get();
    }

    function getFailedAnswerData(int $resultId)
    {
        return $this->result
            ->select([
                'answer_text'
                , 'aq.text as question_text'
                , 'a.question_id'
            ])
            ->selectRaw('min(a.id) as min_id')
            ->from('answers as a')
            ->leftJoin('answer_questions as aq', 'a.question_id', '=', 'aq.id')
            ->where('a.result_id', $resultId)
            ->whereNull('answer_num')
            ->groupBy('a.question_id', 'answer_text')
            ->orderBy('a.question_id')
            ->get();
    }

    function getFailedQuestion(int $questionId)
    {

        return $this->result
            ->from('answer_questions as aq')
            ->where('id', $questionId)
            ->whereNull('question_id')
            ->first();
    }

    function getFailedAnswer(int $answerId)
    {
        return $this->result
            ->select([
                'a.id as id'
                , 'a.result_id as result_id'
                , 'answer_text'
                , 'aq.text as question_text'
                , 'a.question_id'
                , 'aq.question_id as qurin_id'
                , 'q.text as qurin_question_text'
                , 'q.correct_choice as qurin_correct_choice'
                , 'q.wrong_choice_1 as qurin_wrong_choice_1'
                , 'q.wrong_choice_2 as qurin_wrong_choice_2'
                , 'q.wrong_choice_3 as qurin_wrong_choice_3'
            ])
            ->from('answers as a')
            ->leftJoin('answer_questions as aq', 'a.question_id', '=', 'aq.id')
            ->leftJoin('questions as q', 'aq.question_id', '=', 'q.id')
            ->where('a.id', $answerId)
            ->whereNull('answer_num')
            ->first();
    }


}
