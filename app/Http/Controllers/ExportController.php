<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCaseRequest;
use App\UseCases\QuestionUseCase;
use App\UseCases\ResultUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use JetBrains\PhpStorm\Pure;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public QuestionUseCase $questionUC;
    public ResultUseCase $resultUC;
    public function __construct()
    {
        $this->questionUC = new QuestionUseCase();
        $this->resultUC = new ResultUseCase();

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('export.index');
    }

    public function csv_swiz(Response $response): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->questionUC->exportQuestionCSV('swiz');
        return response()->stream($callback, 200, $headers);

    }

    public function csv_pros(Response $response): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->questionUC->exportQuestionCSV('pros');
        return response()->stream($callback, 200, $headers);

    }

    public function csv_learning(Response $response): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->questionUC->exportQuestionCSV('bunseki');
        return response()->stream($callback, 200, $headers);

    }

    public function csv_explanation(Response $response): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->questionUC->exportQuestionCSV('syosai');
        return response()->stream($callback, 200, $headers);
    }

    public function csv_topic(Response $response): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->questionUC->exportQuestionCSV('topic');
        return response()->stream($callback, 200, $headers);
    }

    public function csv_result(Response $response): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->questionUC->exportResultCSV('answer');
        return response()->stream($callback, 200, $headers);
    }

    public function results()
    {
        $results = $this->resultUC->getData();

        return view('export.results', compact('results'));
    }
}
