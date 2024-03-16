<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UseCases\ExaminationUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiExaminationController extends Controller
{
    protected ExaminationUseCase $examinationUC;

    public function __construct()
    {
        $this->examinationUC = new ExaminationUseCase();
    }

    public function paginate(Request $request): JsonResponse
    {
        return response()->json(
            $this->examinationUC->getPaginate($request)
        );
    }

    public function get_data(): JsonResponse
    {
        return response()->json(
            $this->examinationUC->getData()
        );
    }

    public function get_gpt(int $examinationId, int $categoryId): JsonResponse
    {

        return response()->json(
            $this->examinationUC->getGpt($examinationId, $categoryId)
        );
    }
}
