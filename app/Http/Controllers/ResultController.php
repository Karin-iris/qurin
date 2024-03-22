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

    public function index()
    {
        $result_summary = $this->resultUC->getSummary();
        $results = $this->resultUC->getData();
        return view('result.index', compact('result_summary', 'results'));
    }

    public function index_a_q(Request $request, int $resultId)
    {
        $questions = $this->resultUC->getQuestionData($resultId, $request);
        return view('result.index_a_q', compact('questions', 'resultId'));
    }

    public function index_a_s(Request $request, int $resultId)
    {
        [$summary, $students] = $this->resultUC->getStudentData($resultId, $request);
        return view('result.index_a_s', compact('students', 'summary', 'resultId'));
    }

    public function index_q(Request $request)
    {
        $questions = $this->resultUC->getQurinQuestionData($request);
        return view('result.index_q', compact('questions'));
    }

    public function view_q(Request $request, int $questionId)
    {
        $question = $this->resultUC->getQurinQuestion($questionId, $request);
        return view('result.view_q', compact('question'));
    }

    public function index_s(Request $request)
    {
        $students = $this->resultUC->getStudentResultData($request);
        return view('result.index_s', compact('students'));
    }

    public function view_s(Request $request, int $studentId)
    {
        $student = $this->resultUC->getStudentResult($studentId, $request);
        return view('result.view_s', compact('student'));
    }

    public function updates_q(Request $request, int $resultId)
    {
        $this->resultUC->updateQuestionsDummy($request);
        exit();
    }

    public function view_a_s(int $resultId,int $studentId){
        [$summary,$student,$questions] = $this->resultUC->getStudent($studentId,$resultId);
        return view('result.view_a_s', compact('student','summary','questions'));
    }

    public function updates_s(Request $request, int $resultId)
    {
        $this->resultUC->updateStudentsDummy($request);
        exit();
    }
}
