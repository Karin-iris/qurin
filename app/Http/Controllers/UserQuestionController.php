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

class UserQuestionController extends Controller
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
        $user_questions = $this->questionUC->getUserQuestions(Auth::user()->id);
        $user_question_cases = $this->questionUC->getUserQuestionCases(Auth::user()->id);
        return view('userquestion.index', compact('user_questions', 'user_question_cases'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(int $id): View
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();
        $user_question = $this->questionUC->getUserQuestion($id);
        return view('userquestion.edit',
            compact('user_question','p_categories', 's_categories', 'categories')
        );
    }

    public function edit_c(int $id): View
    {
        $user_question_case = $this->questionUC->getUserQuestionCase($id);
        return view('userquestion.edit_c',
            compact('user_question_case')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id): RedirectResponse
    {
        $this->questionUC->updateUserQuestion($request, $id);
        return Redirect::route('userquestion.edit', $id)->with('status', 'question-updated');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_c(QuestionCaseRequest $request, int $id): RedirectResponse
    {
        $this->questionUC->updateUserQuestionCase($request, $id);
        return Redirect::route('userquestion.edit_c', $id)->with('status', 'question-updated');
    }

    public function create()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();

        return view('userquestion.create', compact('p_categories', 's_categories', 'categories'));//
    }

    public function create_c()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();

        return view('userquestion.create_c', compact('p_categories', 's_categories', 'categories'));//
    }

    public function store(QuestionRequest $request)
    {
        $this->questionUC->saveUserQuestion($request);
        return Redirect::route('userquestion.create')->with('question', 'saved');//
    }

    public function store_c(QuestionCaseRequest $request)
    {
        $this->questionUC->saveUserQuestionCase($request);
        return Redirect::route('question.create')->with('question', 'saved');//
    }

}
