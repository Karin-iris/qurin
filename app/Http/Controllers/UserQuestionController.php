<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\UseCases\CategoryUseCase;
use App\UseCases\QuestionUseCase;
use App\UseCases\SectionUseCase;
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
    protected SectionUseCase $sectionUC;
    #[Pure] public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
        $this->questionUC = new QuestionUseCase();
        $this->sectionUC = new SectionUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_questions = $this->questionUC->getUserQuestions(Auth::user()->id);
        return view('userquestion.index', compact('user_questions'));
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
        $sections =$this->sectionUC->getList();
        return view('userquestion.edit',
            compact('user_question','p_categories', 's_categories', 'categories','sections')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, int $id): RedirectResponse
    {
        $status = $this->questionUC->updateUserQuestion($request, $id);
        $this->questionUC->updateUserQuestionImage($request,$id);
        return Redirect::route('userquestion.index')->with('status', $status);
    }

    public function create()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();
        $sections =$this->sectionUC->getList();
        return view('userquestion.create', compact('p_categories', 's_categories', 'categories','sections'));
    }

    public function store(QuestionRequest $request)
    {
        $status = $this->questionUC->addUserQuestion($request);
        return Redirect::route('userquestion.index')->with('status', $status);//
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->questionUC->delUserQuestion($id);
        return Redirect::route('userquestion.index')->with('question', 'deleted');//
    }
}
