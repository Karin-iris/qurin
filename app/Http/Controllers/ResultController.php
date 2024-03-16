<?php

namespace App\Http\Controllers;

use App\UseCases\ResultUseCase;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public ResultUseCase $resultUC;
    public function __construct()
    {
        $this->resultUC = new ResultUseCase();
    }

    public function index_a_q(Request $request, int $resultId)
    {
        $questions = $this->resultUC->getQuestionData($resultId, $request);
        return view('result.index_a_q', compact('questions', 'resultId'));
    }
    public function index_a_s(Request $request, int $resultId)
    {
        $students = $this->resultUC->getStudentData($resultId, $request);
        return view('result.index_a_s', compact('students', 'resultId'));
    }


}
