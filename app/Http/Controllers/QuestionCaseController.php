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
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use JetBrains\PhpStorm\Pure;

class QuestionCaseController extends Controller
{
    public CategoryUseCase $categoryUC;
    public QuestionUseCase $questionUC;
    public QuestionCaseUseCase $questionCaseUC;

    public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
        $this->questionUC = new QuestionUseCase();
        $this->questionCaseUC = new QuestionCaseUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $question_cases = $this->questionCaseUC->getQuestionCases();
        return view('question_case.index', compact('question_cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('question_case.create');//
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
    public function store(QuestionCaseRequest $request): RedirectResponse
    {
        $this->questionCaseUC->saveQuestionCase($request);
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

        return view('question_case.edit', compact('p_categories', 's_categories', 'categories', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id)
    {

        $status = $this->questionUC->updateQuestion($request, $id);
        return Redirect::route('question_case.index')->with('status', $status);////
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->questionUC->delQuestion($id);
        return Redirect::route('question_case.index')->with('question', 'deleted');//
    }
}
