<?php

namespace App\Repositories;

use App\Http\Requests\QuestionRequest;
use App\Http\Requests\Questions\SearchRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionRepository extends Repository
{
    protected Question $question;

    public function __construct()
    {
        $this->question = new Question;
    }

    public function add(QuestionRequest $request)
    {
        try {
            $this->question->fill([
                'topic' => $request->input('topic'),
                'section_id' => $request->input('section_id'),
                'compitency' => $request->input('compitency'),
                'text' => $request->input('text'),
                'quiz_id' => $request->input('quiz_id'),
                'category_id' => $request->input('category_id'),
                'correct_choice' => $request->input('correct_choice'),
                'wrong_choice_1' => $request->input('wrong_choice_1'),
                'wrong_choice_2' => $request->input('wrong_choice_2'),
                'wrong_choice_3' => $request->input('wrong_choice_3'),
                'explanation' => $request->input('explanation'),
                'is_request' => $request->input('is_request'),
                'is_remand' => $request->input('is_remand'),
                'is_adopt' => $request->input('is_adopt'),
                'user_id' => Auth::user()->id
            ])->save();
            return 'saved';
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in updateQuestion: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function update(QuestionRequest $request, int $id)
    {
        try {
            $r= $this->question->find($id)->fill([
                'topic' => $request->input('topic'),
                'compitency' => $request->input('compitency'),
                'text' => $request->input('text'),
                'section_id' => $request->input('section_id'),
                'category_id' => $request->input('category_id'),
                'quiz_id' => $request->input('quiz_id'),
                'correct_choice' => $request->input('correct_choice'),
                'wrong_choice_1' => $request->input('wrong_choice_1'),
                'wrong_choice_2' => $request->input('wrong_choice_2'),
                'wrong_choice_3' => $request->input('wrong_choice_3'),
                'explanation' => $request->input('explanation'),
                'is_request' => $request->input('is_request'),
                'is_approve' => $request->input('is_approve'),
                'is_adopt' => $request->input('is_adopt'),
                'is_remand' => $request->input('is_remand'),
            ])->save();
            $status = "updated";
            if ($request->input('is_approve') === "1") {
                $status = "approved";
            }
            if ($request->input('is_approve') === "0" && $request->input('is_request') === "0") {
                $status = "remand";
            }
            return $status;
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in updateQuestion: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }
}
