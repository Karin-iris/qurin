<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCaseRequest;
use App\Http\Requests\QuestionRequest;
use App\UseCases\CategoryUseCase;
use App\UseCases\QuestionUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use JetBrains\PhpStorm\Pure;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public $categoryUC;
    public $questionUC;

    public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
        $this->questionUC = new QuestionUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionUC->getQuestions();
        $question_cases = $this->questionUC->getQuestionCases();
        return view('question.index', compact('questions', 'question_cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();
        return view('question.create', compact('p_categories', 's_categories', 'categories'));//
    }

    public function create_c()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();

        return view('question.create_c', compact('p_categories', 's_categories', 'categories'));//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $this->questionUC->saveQuestion($request);
        return Redirect::route('question.create')->with('question', 'saved');//
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = $this->questionUC->getQuestion($id);
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();

        return view('question.edit', compact('question', 'p_categories', 's_categories', 'categories'));//
    }

    public function edit_c(int $id): View
    {
        $question_case = $this->questionUC->getQuestionCase($id);
        return view('question.edit_c',
            compact('question_case')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id)
    {

        $status = $this->questionUC->updateQuestion($request, $id);
        return Redirect::route('question.index')->with('status', $status);////
    }

    public function update_c(QuestionCaseRequest $request, int $id): RedirectResponse
    {
        $this->questionUC->updateQuestionCase($request, $id);
        return Redirect::route('question.edit_c')->with('status', 'question-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->questionUC->delQuestion($id);
        return Redirect::route('question.index')->with('question', 'deleted');//
    }

    public function destroy_c(int $id)
    {
        $this->questionUC->delQuestionCase($id);
        return Redirect::route('question.index')->with('question', 'deleted');//
    }

    public function csv(Response $response)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=試験問題リスト.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        $callback = function () {
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'SectionID',
                'Section Row Index',
                'Quiz ID',
                '形式',
                '問題文',
                'スコア',
                '解説（任意）',
                '追加の選択肢（任意）',
                '選択肢の順番をランダムにする',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $questions = DB::table('questions');

            $questionData = $questions
                ->select(['id', 'text', 'correct_choice', 'wrong_choice_1', 'wrong_choice_2', 'wrong_choice_3'])
                ->where('is_approve', 1)->get();

            foreach ($questionData as $question) {
                $csv = [
                    '',
                    '',
                    '',
                    '',
                    $question->text,
                    '',
                    '',
                    '',
                    'true',
                    $question->correct_choice,
                    'true',
                    $question->wrong_choice_1,
                    'false',
                    $question->wrong_choice_2,
                    'false',
                    $question->wrong_choice_3,
                    'false'
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };
        //return \Maatwebsite\Excel\Facades\Excel::download(\App\Models\Question::all(), 'users.xlsx');
        return response()->stream($callback, 200, $headers);

    }
}
