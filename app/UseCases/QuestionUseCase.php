<?php

namespace App\UseCases;

use App\Http\Requests\QuestionCaseRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\Questions\SearchRequest;
use App\Mail\QuestionApproveMail;
use App\Mail\QuestionRemandMail;
use App\Mail\QuestionRequestMail;
use App\Models\Question;
use App\Models\QuestionImage;
use App\QueryServices\QuestionQueryService;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class QuestionUseCase extends UseCase
{

    public Question $question;
    public QuestionImage $question_image;
    public QuestionRepository $questionR;
    public QuestionQueryService $questionQS;
    public array $question_summary_column;
    public array $question_admin_summary_column;
    public array $question_detail_column;

    function __construct()
    {
        $this->question = new Question();
        $this->question_image = new QuestionImage();
        $this->questionR = new QuestionRepository();
        $this->questionQS = new QuestionQueryService();
        $this->question_summary_column = [
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'p.code as p_c_code',
            's.code as s_c_code',
            'c.code as c_code',
            'q.compitency as compitency',
            'q.topic as topic',
            'q.id as id',
            'q.quiz_id as quiz_id',
            'q.is_request as is_request',
            'q.is_approve as is_approve',
            'q.is_remand as is_remand',
            'q.created_at as created_at',
            'q.updated_at as updated_at',
        ];
        $this->question_admin_summary_column = [
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'p.code as p_c_code',
            's.code as s_c_code',
            'c.code as c_code',
            'q.topic as topic',
            'q.section_id as section_id',
            'q.id as id',
            'q.quiz_id as quiz_id',
            'q.user_name as user_name',
            'q.is_request as is_request',
            'q.is_approve as is_approve',
            'q.is_remand as is_remand',
            'q.created_at as created_at',
            'q.updated_at as updated_at',
        ];
        $this->question_detail_column = [
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'p.id as p_c_id',
            's.id as s_c_id',
            'c.id as c_id',
            'q.topic as topic',
            'q.section_id as section_id',
            'q.user_name as user_name',
            'q.compitency as compitency',
            'q.id as id',
            'q.quiz_id as quiz_id',
            'q.text as text',
            'q.correct_choice as correct_choice',
            'q.wrong_choice_1 as wrong_choice_1',
            'q.wrong_choice_2 as wrong_choice_2',
            'q.wrong_choice_3 as wrong_choice_3',
            'q.is_remand as is_remand',
            'q.is_adopt as is_adopt',
            'q.created_at as created_at',
            'q.updated_at as updated_at',
            'q.explanation as explanation'
        ];

    }

    function getData()
    {
        return $this->question->get();
    }

    function getPaginate(Request $request)
    {
        return $this->questionQS->getPaginate($request);
    }

    function getQuestion(int $id): Question
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

    function getUserSummary()
    {
        return $this->question->select(
            ['user_id']
        )->selectRaw('COUNT(q.id) as count_questions')
            ->from('questions as q')->
            groupBy('user_id')->get();
    }

    function getSecondaryCategorySummary()
    {
        return $this->question->select(
            ['s.name as s_c_name']
        )->selectRaw('COUNT(q.id) as count_questions')
            ->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->groupBy('s.id')->get();
    }

    function getQuestions(SearchRequest $request)
    {
        Log::info('Request', $request->all());

        return $this->questionQS->getQuestions($request);
    }

    function getQuestionExports()
    {
        return $this->question->select(
            [
                'p.code as p_c_code',
                's.code as s_c_code',
                'c.code as c_code',
                'q.id as id',
                'q.quiz_id as quiz_id',
                'q.text as text',
                'q.correct_choice as correct_choice',
                'q.wrong_choice_1 as wrong_choice_1',
                'q.wrong_choice_2 as wrong_choice_2',
                'q.wrong_choice_3 as wrong_choice_3',
                'sec.sec_id as section_id',
                'sec.title as section_title',
                'q.is_adopt',
            ]
        )->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->leftJoin('sections as sec', 'sec.id', '=', 'q.section_id')
            ->Where('is_approve', '1')->get();
    }

    function getQuestionExportDetail()
    {
        return $this->question->select(
            [
                'p.name as p_c_name',
                's.name as s_c_name',
                'c.name as c_name',
                'p.code as p_c_code',
                's.code as s_c_code',
                'c.code as c_code',
                'q.id as id',
                'q.quiz_id as quiz_id',
                'q.text as text',
                'q.topic as topic',
                'q.explanation as explanation',
                'q.correct_choice as correct_choice',
                'q.wrong_choice_1 as wrong_choice_1',
                'q.wrong_choice_2 as wrong_choice_2',
                'q.wrong_choice_3 as wrong_choice_3'
            ]
        )->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->Where('is_approve', '1')->get();
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
        $question['images'] = $this->question_image->where('question_id', $id)->paginate(30);
        return $question;
    }

    function getUserQuestions(int $user_id)
    {
        $model = $this->question->select(
            $this->question_summary_column
        )->from('questions as q')
            ->rightJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->rightJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->rightJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->where([['q.user_id', $user_id]]);
        return $model->get();
    }

    function saveQuestion(QuestionRequest $request)
    {
        $this->questionR->saveQuestion($request);
    }

    function addUserQuestion(QuestionRequest $request): string
    {
        $this->question->fill([
            'topic' => $request->input('topic'),
            'compitency' => $request->input('compitency'),
            'text' => $request->input('text'),
            'quiz_id' => $request->input('quiz_id'),
            'section_id' => $request->input('section_id'),
            'category_id' => $request->input('category_id'),
            'correct_choice' => $request->input('correct_choice'),
            'wrong_choice_1' => $request->input('wrong_choice_1'),
            'wrong_choice_2' => $request->input('wrong_choice_2'),
            'wrong_choice_3' => $request->input('wrong_choice_3'),
            'explanation' => $request->input('explanation'),
            'is_request' => $request->input('is_request'),
            'is_remand' => $request->input('is_remand'),
            'user_id' => Auth::user()->id
        ])->save();
        if ($request->input('is_request') === "1") {
            $status = "request";
            //$this->sendRequestMail($request);
        } else {
            $status = "saved";
        }
        return $status;
    }

    function saveTmpQuestion($id, $text)
    {
        $this->question->insert([
            'id' => $id,
            'text' => $text
        ]);
    }

    function update(QuestionRequest $request, int $id): string
    {
        return $this->questionR->update($request,$id);
    }

    function updateUserQuestion(QuestionRequest $request, int $id): string
    {
        $this->question->find($id)->fill([
            'topic' => $request->input('topic'),
            'compitency' => $request->input('compitency'),
            'text' => $request->input('text'),
            'section_id' => $request->input('section_id'),
            'quiz_id' => $request->input('quiz_id'),
            'category_id' => $request->input('category_id'),
            'correct_choice' => $request->input('correct_choice'),
            'wrong_choice_1' => $request->input('wrong_choice_1'),
            'wrong_choice_2' => $request->input('wrong_choice_2'),
            'wrong_choice_3' => $request->input('wrong_choice_3'),
            'explanation' => $request->input('explanation'),
            'is_request' => $request->input('is_request'),
            'is_remand' => $request->input('is_remand'),
            'user_id' => Auth::user()->id
        ])->save();
        if ($request->input('is_request') === "1") {
            $status = "request";
            //$this->sendRequestMail($request);
        } else {
            $status = "saved";
        }
        return $status;
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

    function delUserQuestion($id)
    {
        $this->question->find($id)->delete();
    }

    function sendRequestMail(QuestionRequest $request)
    {
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new QuestionRequestMail($name, $email));
    }

    function sendApprovalMail(QuestionRequest $request)
    {
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new QuestionApproveMail($name, $email));
    }

    function sendRemandMail(QuestionRequest $request)
    {
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new QuestionRemandMail($name, $email));
    }
}
