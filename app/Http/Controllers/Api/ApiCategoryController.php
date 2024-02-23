<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\UseCases\CategoryUseCase;
use Illuminate\Database\Eloquent\Casts\Json;
use JetBrains\PhpStorm\Pure;

class ApiCategoryController extends ApiController
{
    public CategoryUseCase $categoryUC;

    #[Pure] public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
    }

    public function get(){
        return response()->json(
            $this->categoryUC->getAllCategories()
        );
    }
    public function get_gpt(int $category_id){
        return response()->json(
            $this->categoryUC->getGptQuery($category_id)
        );
    }

    public function get_gpt2(int $category_id){
        return response()->json(
            $this->categoryUC->getGptQuery2($category_id)
        );
    }
    public function get_primaries()
    {
        return response()->json(
            $this->categoryUC->getPrimaryCategories()
        );
    }
    public function get_secondaries(int $id){
        return response()->json(
            $this->categoryUC->getSecondaryCategories($id)
        );
    }
    public function get_children(int $id){
        return response()->json(
            $this->categoryUC->getChildCategories($id)
        );
    }
    public function upload(){

    }
}
