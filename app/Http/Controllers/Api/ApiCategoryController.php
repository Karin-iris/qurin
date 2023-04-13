<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\UseCases\CategoryUseCase;
use JetBrains\PhpStorm\Pure;

class ApiCategoryController extends ApiController
{
    public CategoryUseCase $categoryUC;

    #[Pure] public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
    }

    public function index(){
        echo "aaaa";
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
