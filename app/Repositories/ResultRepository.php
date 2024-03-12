<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Result;
use App\Models\AnswerQuestion;
use App\Models\Answer;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
    function updateFailedAnswer(Request $request, int $id)
    {
        try {
            $this->answer::find($id)->fill([
                'answer_num' => $request->input('answer_num'),
            ])->save();
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateFailedAnswer: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }
    public function updateFailedAnswers(int $result_id,String $answer_text,int $answer_num){
        try {
            DB::table('answers')
                ->where('answer_text', $answer_text/*$request->input('answer_text')*/)
                ->where('result_id', $result_id/*$request->input('result_id')*/)
                ->update(['answer_num' => $answer_num/*$request->input('answer_num')*/]);
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateFailedAnswer: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }

    }
}
