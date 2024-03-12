<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\Result;

class ResultQueryService extends QueryService
{
    protected Result $result;

    function __construct()
    {
        $this->result = new Result;
    }

    function get()
    {
        $results = $this->result->select([
            'r.id as id',
            'r.title as title'
        ])
            ->selectRaw('COUNT(aq.id) as questions_count')
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
        return $results;
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
                ,'aq.text as question_text'
                ,'a.question_id'
            ])
            ->selectRaw('min(a.id) as min_id')
            ->from('answers as a')
            ->leftJoin('answer_questions as aq', 'a.question_id', '=', 'aq.id')
            ->where('a.result_id', $resultId)
            ->whereNull('answer_num')
            ->groupBy('a.question_id','answer_text')
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

    function getFailedAnswer(int $answerId){
        return $this->result
                ->select([
                    'a.id as id'
                    ,'a.result_id as result_id'
                    ,'answer_text'
                    ,'aq.text as question_text'
                    ,'a.question_id'
                    ,'aq.question_id as qurin_id'
                    ,'q.text as qurin_question_text'
                    ,'q.correct_choice as qurin_correct_choice'
                    ,'q.wrong_choice_1 as qurin_wrong_choice_1'
                    ,'q.wrong_choice_2 as qurin_wrong_choice_2'
                    ,'q.wrong_choice_3 as qurin_wrong_choice_3'
                ])
            ->from('answers as a')
            ->leftJoin('answer_questions as aq', 'a.question_id', '=', 'aq.id')
            ->leftJoin('questions as q', 'aq.question_id', '=', 'q.id')
            ->where('a.id', $answerId)
            ->whereNull('answer_num')
            ->first();
    }


}
