<?php

namespace App\UseCases;

use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionCaseRequest;
use App\Http\Requests\QuestionImageRequest;
use App\Models\Question;
use App\Models\QuestionCase;
use App\Models\QuestionImage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionUseCase extends UseCase
{

    public Question $question;
    public QuestionCase $question_case;
    public QuestionImage $question_image;

    function __construct()
    {
        $this->question = new Question();
        $this->question_case = new QuestionCase();
        $this->question_image = new QuestionImage();
        $this->question_summary_column = [];
        $this->question_detail_column = [
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'q.topic as topic',
            'q.id as id',
            'q.text as text',
            'q.correct_choice as correct_choice',
            'q.wrong_choice_1 as wrong_choice_1',
            'q.wrong_choice_2 as wrong_choice_2',
            'q.wrong_choice_3 as wrong_choice_3',
            'q.created_at as created_at',
            'q.updated_at as updated_at',
            'q.explanation as explanation'
        ];

    }

    function getQuestion(int $id)
    {
        return $this->question->select([
            'p.name as p_name',
            's.name as s_name',
            'c.name as name',
            '*'
        ])
            ->where('id', $id)->firstOrFail();
    }

    function getQuestionCase(int $id)
    {
        return $this->question_case->where('id', $id)->firstOrFail();
    }

    function getQuestions()
    {
        $user_questions = $this->question->get();
        return $user_questions;
    }

    function getQuestionCases()
    {
        $question_cases = $this->question_case->get();
        return $question_cases;
    }

    function getUserQuestion(int $id)
    {
        $question = $this->question->select(
            $this->question_detail_column
        )->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->where('q.id', $id)->firstOrFail();
        $question['images'] = $this->question_image->where('question_id', $id)->get();
        return $question;
    }

    function getUserQuestionCase(int $id)
    {
        return $this->question_case->where('id', $id)->firstOrFail();
    }

    function getUserQuestions(int $user_id)
    {
        $model = $this->question->select([
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'q.topic as topic',
            'q.id as id',
            'q.created_at as created_at',
            'q.updated_at as updated_at',
        ])->from('questions as q')
            ->rightJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->rightJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->rightJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->where([['q.user_id', $user_id], ['is_request', '!=', '1']]);
        return $model->get();
    }

    function getUserQuestionCases(int $user_id)
    {
        $user_question_cases = $this->question_case->where('user_id', $user_id)->get();
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
            'category_id' => $request->input('category_id'),
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

    function updateQuestionCase(QuestionCaseRequest $request, int $id)
    {
        $this->question_case->find($id)->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }

    function updateUserQuestionCase(QuestionCaseRequest $request, int $id)
    {
        $this->question_case->find($id)->fill([
            'topic' => $request->input('topic'),
            'text' => $request->input('text'),
            'explanation' => $request->input('explanation'),
            'user_id' => Auth::user()->id
        ])->save();
    }

    function updateUserQuestionImage(QuestionRequest $request, int $id)
    {
        if ($request->file('image')) {
            $fileObjectArray = $request->file('image');
            $fileIdArray = $request->input('image_id');
            $fileNameArray = [];
            foreach ($fileObjectArray as $key => $fileObject) {
                $ext = $fileObject->getClientOriginalExtension();
                if (in_array($ext, array("jpeg", 'jpg'))) {
                    $dateYmd = date('Ymd');
                    $fileName = $dateYmd . date('His') . sprintf('%03d', rand(0, 999)) . '.' . $ext;
                    $fileNameArray[$key] = $fileName;
                    Storage::disk('public')->putFileAs($dateYmd, $fileObject, $fileNameArray[$key]);
                    if (!empty($fileIdArray[$key])) {
                        $question_image = $this->question_image->find($fileIdArray[$key]);
                    } else {
                        $question_image = $this->question_image;
                    }
                    $question_image->fill([
                        'question_id' => $id,
                        'filepath' => $dateYmd,
                        'filename' => $fileName
                    ])->save();
                }
            }
            return $fileNameArray;
        }

    }

    function delQuestion($id)
    {
        $this->question->find($id)->delete();
    }

    function delQuestionCase($id)
    {
        $this->question_case->find($id)->delete();
    }

    function delUserQuestion($id)
    {
        $this->question->find($id)->delete();
    }

    function delUserQuestionCase($id)
    {
        $this->question_case->find($id)->delete();
    }
}
