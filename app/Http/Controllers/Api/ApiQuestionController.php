<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\UseCases\CategoryUseCase;
use JetBrains\PhpStorm\Pure;

class ApiQuestionController extends ApiController
{
    public QuestionUseCase $questionUC;

    #[Pure] public function __construct()
    {
        $this->questionUC = new QuestionUseCase();
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
