<?php

namespace App\UseCases;

use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionCaseRequest;
use App\Models\Question;
use App\Models\QuestionCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionUseCase extends UseCase{

    public Question $question;

    function __construct()
    {
        $this->question = new Question();
        $this->question_case = new QuestionCase();
    }
    function getQuestion(int $id)
    {
        return $this->question->where('id', $id)->firstOrFail();
    }

    function getQuestionCase(int $id)
    {
        return $this->question_case->where('id', $id)->firstOrFail();
    }

    function getQuestions(){
        $user_questions = $this->question->get();
        return $user_questions;
    }

    function getQuestionCases(){
        $question_cases = $this->question_case->get();
        return $question_cases;
    }

    function getUserQuestion(int $id)
    {
        return $this->question->where('id', $id)->firstOrFail();
    }

    function getUserQuestionCase(int $id)
    {
        return $this->question_case->where('id', $id)->firstOrFail();
    }

    function getUserQuestions(int $user_id){
        $user_questions = $this->question->where('user_id',$user_id)->get();
        return $user_questions;
    }

    function getUserQuestionCases(int $user_id){
        $user_question_cases = $this->question_case->where('user_id',$user_id)->get();
        return $user_question_cases;
    }

    function saveQuestion(QuestionRequest $request)
    {
        $this->question->fill($request->all())->save();
    }
    function saveUserQuestion(QuestionRequest $request)
    {
        $this->question->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'correct_choice' => $request->input('correct_choice'),
            'wrong_choice_1' => $request->input('wrong_choice_1'),
            'wrong_choice_2' => $request->input('wrong_choice_2'),
            'wrong_choice_3' => $request->input('wrong_choice_3'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }

    function saveUserQuestionCase(QuestionCaseRequest $request)
    {
        $this->question_case->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }
    function updateQuestion(QuestionRequest $request, int $id): void
    {
        $this->question->find($id)->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'correct_choice' => $request->input('correct_choice'),
            'wrong_choice_1' => $request->input('wrong_choice_1'),
            'wrong_choice_2' => $request->input('wrong_choice_2'),
            'wrong_choice_3' => $request->input('wrong_choice_3'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }

    function updateUserQuestion(QuestionRequest $request, int $id): void
    {
        $this->question->find($id)->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'correct_choice' => $request->input('correct_choice'),
            'wrong_choice_1' => $request->input('wrong_choice_1'),
            'wrong_choice_2' => $request->input('wrong_choice_2'),
            'wrong_choice_3' => $request->input('wrong_choice_3'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }
    function updateQuestionCase(QuestionCaseRequest $request,int $id)
    {
        $this->question_case->find($id)->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }
    function updateUserQuestionCase(QuestionCaseRequest $request,int $id)
    {
        $this->question_case->find($id)->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }
}
