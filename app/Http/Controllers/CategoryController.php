<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryPrimaryRequest;
use App\Http\Requests\CategorySecondaryRequest;
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

        return view('category.create', compact('p_categories', 's_categories'));
    }

    public function create_p()
    {
        return view('category.create_p');
    }

    public function create_s()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        return view('category.create_s', compact('p_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryUC->saveCategory($request);
        return Redirect::route('category.create')->with('category', 'saved');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_p(CategoryPrimaryRequest $request)
    {
        $this->categoryUC->savePrimaryCategory($request);
        return Redirect::route('category.create_p')->with('category', 'saved');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store_s(CategorySecondaryRequest $request)
    {
        $this->categoryUC->saveSecondaryCategory($request);
        return Redirect::route('category.create_s')->with('category', 'saved');
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

        return view('category.edit', compact('category', 'categories', 'p_categories', 's_categories'));//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_p(string $id):View
    {
        $p_category = $this->categoryUC->getPrimaryDetail($id);

        return view('category.edit_p', compact('p_category'));//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_s(string $id)
    {
        $s_category = $this->categoryUC->getSecondaryDetail($id);
        $p_categories = $this->categoryUC->getPrimaryCategories();
        return view('category.edit_s', compact('s_category', 'p_categories'));//
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //$this->categoryUC->updateCategoryOrder(100, $id);
        $this->categoryUC->updateCategory($request, $id);
        return Redirect::route('category.edit', $id)->with('category', 'updated');//
    }
    public function update_p(CategoryPrimaryRequest $request, string $id)
    {
        //$this->categoryUC->updateCategoryOrder(100, $id);
        $this->categoryUC->updatePrimaryCategory($request, $id);
        return Redirect::route('category.edit', $id)->with('category', 'updated');//
    }
    public function update_s(CategorySecondaryRequest $request, string $id)
    {
        //$this->categoryUC->updateCategoryOrder(100, $id);
        $this->categoryUC->updateSecondaryCategory($request, $id);
        return Redirect::route('category.edit', $id)->with('category', 'updated');//
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryUC->delCategory($id);
        //
    }
    public function destroy_p(string $id)
    {
        $this->categoryUC->delPrimaryCategory($id);
        //
    }
    public function destroy_s(string $id)
    {
        $this->categoryUC->delSecondaryCategory($id);
        //
    }
}
