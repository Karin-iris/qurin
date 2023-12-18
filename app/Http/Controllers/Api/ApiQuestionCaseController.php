<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\UseCases\QuestionCaseUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\Pure;

class ApiQuestionCaseController extends ApiController
{
    public QuestionCaseUseCase $questionCaseUC;

    public function __construct()
    {
        $this->questionCaseUC = new QuestionCaseUseCase();
    }

    public function get_question_cases() : JsonResponse
    {
        return response()->json(
            $this->questionCaseUC->getQuestionCases()
        );
    }
    public function get_question_case_questions(int $id) : JsonResponse
    {
        return response()->json(
            $this->questionCaseUC->getCaseQuestions($id)
        );
    }

}
