<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\UseCases\QuestionUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\Pure;

class ApiQuestionController extends ApiController
{
    public QuestionUseCase $questionUC;

    #[Pure] public function __construct()
    {
        $this->questionUC = new QuestionUseCase();
    }

    public function paginate(Request $request) : JsonResponse
    {
        return response()->json(
            $this->questionUC->getPaginate($request)
        );
    }

    public function get_user_summary(){
        return response()->json(
            $this->questionUC->getUserSummary()
        );
    }

    public function get_secondary_category_summary(){
        return response()->json(
            $this->questionUC->getSecondaryCategorySummary()
        );
    }

}
