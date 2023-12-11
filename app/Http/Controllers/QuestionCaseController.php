<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCaseRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionFileRequest;
use App\Models\Question;
use App\UseCases\CategoryUseCase;
use App\UseCases\QuestionUseCase;
use App\UseCases\QuestionCaseUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use JetBrains\PhpStorm\Pure;
use Maatwebsite\Excel\Facades\Excel;

class QuestionCaseController extends Controller
{
    public $categoryUC;
    public $questionUC;
    public $questionCaseUC;

    public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
        $this->questionUC = new QuestionUseCase();
        $this->questionCaseUC = new QuestionCaseUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question_cases = $this->questionUC->getQuestionCases();
        return view('question_case.index', compact('question_cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();
        return view('question_case.create', compact('p_categories', 's_categories', 'categories'));//
    }

    public function create_c()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();

        return view('question_case.create_c', compact('p_categories', 's_categories', 'categories'));//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $this->questionUC->saveQuestion($request);
        return Redirect::route('question_case.create')->with('question', 'saved');//
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
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();

        $question = $this->questionCaseUC->getCaseQuestion($id);

        return view('question_case.edit',compact('p_categories', 's_categories', 'categories','question'));
    }

    public function edit_c(int $id): View
    {
        $question_case = $this->questionCaseUC->getQuestionCase($id);
        $questions = $this->questionCaseUC->getCaseQuestions($question_case->id);
        return view('question_case.edit_c',compact('question_case','questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id)
    {

        $status = $this->questionUC->updateQuestion($request, $id);
        return Redirect::route('question_case.index')->with('status', $status);////
    }

    public function update_c(QuestionCaseRequest $request, int $id): RedirectResponse
    {
        $this->questionUC->updateQuestionCase($request, $id);
        return Redirect::route('question_case.edit_c')->with('status', 'question-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->questionUC->delQuestion($id);
        return Redirect::route('question_case.index')->with('question', 'deleted');//
    }

    public function destroy_c(int $id)
    {
        $this->questionUC->delQuestionCase($id);
        return Redirect::route('question_case.index')->with('question', 'deleted');//
    }
}
