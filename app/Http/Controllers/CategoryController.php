<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;
use App\UseCases\CategoryUseCase;
use JetBrains\PhpStorm\Pure;

class CategoryController extends Controller
{
    public CategoryUseCase $categoryUC;

    #[Pure] public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = $this->categoryUC->getAllCategories();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();

        return view('category.create',compact('p_categories','s_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryUC->saveCategory($request);
        return Redirect::route('category.create')->with('category', 'saved');
    }

    public function create_p()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_p(Request $request)
    {
        //
    }

    public function create_s()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_s(Request $request)
    {
        //
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
        $category = $this->categoryUC->getDetail($id);
        $categories = $this->categoryUC->getAllCategories();
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();

        return view('category.edit',compact('category','categories','p_categories','s_categories'));//
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $this->categoryUC->updateCategoryOrder(100,$id);
        $this->categoryUC->updateCategory($request,$id);
        return Redirect::route('category.edit',$id)->with('category', 'saved');//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
