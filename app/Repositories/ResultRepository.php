<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Result;
use App\Models\AnswerQuestion;
use App\Models\Answer;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\DataTransferObjects\DataTransferObject;

class ResultRepository extends Repository
{
    protected Result $result;
    protected AnswerQuestion $answer_question;
    protected Answer $answer;

    function __construct()
    {
        $this->result = new Result;
        $this->answer_question = new AnswerQuestion;
        $this->answer = new Answer;
    }

    function insertGetId($title)
    {
        $id = $this->result->insertGetId([
            'title' => $title,
            'created_at' => Carbon::now()
        ]);
        return $id;
    }

    function updateFailedQuestion(Request $request, int $id)
    {
        try {
            $this->answer_question::find($id)->fill([
                'question_id' => $request->input('question_id'),
            ])->save();
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateFailedQuestion: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    function updateFailedAnswer(array $paramArray, int $id)
    {
        try {
            $answer_num = $paramArray['answer_num'];
            $this->answer::find($id)->fill([
                'answer_num' => $answer_num,
            ])->save();
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateFailedAnswer: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function updateFailedAnswers(array $paramArray)
    {
        try {
            DB::table('answers')
                ->where('answer_text', $paramArray['answer_text'])
                ->where('result_id', $paramArray['result_id'])
                ->update(['answer_num' => $paramArray['answer_num']]);
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateFailedAnswer: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }

    }

    public function updateQuestionsDummy(int $id, string $is_dummy)
    {
        try {
            DB::table('answer_questions')
                ->where('id', $id)
                ->update(['is_dummy' => $is_dummy]);
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateFailedAnswer: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function updateStudentsDummy(int $id, string $is_dummy)
    {
        try {
            DB::table('answer_students')
                ->where('id', $id)
                ->update(['is_dummy' => $is_dummy]);
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateFailedAnswer: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }
}
