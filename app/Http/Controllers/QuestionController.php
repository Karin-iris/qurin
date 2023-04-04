<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionCaseRequest;
use App\UseCases\CategoryUseCase;
use App\UseCases\QuestionUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use JetBrains\PhpStorm\Pure;

class QuestionController extends Controller
{
    public CategoryUseCase $categoryUC;
    public QuestionUseCase $questionUC;

    #[Pure] public function __construct()
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
        return view('question.index', compact('questions','question_cases'));
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
        $question = DB::table('questions')->find($id);
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
        $this->questionUC->updateQuestion($request, $id);
        return Redirect::route('question.edit',$id)->with('question', 'saved');////
    }

    public function update_c(QuestionCaseRequest $request, int $id): RedirectResponse
    {
        $this->questionUC->updateQuestionCase($request, $id);
        return Redirect::route('question.edit_c', $id)->with('status', 'question-updated');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //論理削除
        //
    }

    public function destroy_c(string $id)
    {
        //論理削除
        //
    }
}
