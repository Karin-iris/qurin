<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UseCases\ExaminationUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiExaminationController extends Controller
{
    protected ExaminationUseCase $examinationUC;
    public function __construct(){
        $this->examinationUC = new ExaminationUseCase();
    }
    public function get() : JsonResponse
    {
        return response()->json(
            $this->examinationUC->getExaminations()
        );
    }
}
