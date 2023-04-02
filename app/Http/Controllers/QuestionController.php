<?php

namespace App\Http\Controllers;

use App\UseCases\CategoryUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use JetBrains\PhpStorm\Pure;

class QuestionController extends Controller
{
    public CategoryUseCase $categoryUC;

    #[Pure] public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = DB::table('questions')->get();
        return view('question.index', compact('questions'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->questionUC->updateQuestion($request);
        return Redirect::route('question.edit',$id)->with('question', 'saved');////
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //論理削除
        //
    }
}
