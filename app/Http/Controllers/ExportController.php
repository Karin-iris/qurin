<?php

namespace App\Http\Controllers;

use App\UseCases\QuestionUseCase;
use App\UseCases\ResultUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

    public function csv_raw(Response $response): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->questionUC->exportQuestionCSV('raw');
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

    public function results()
    {
        $results = $this->resultUC->getData();

        return view('export.results', compact('results'));
    }

    public function csv_result(Response $response, int $id): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->resultUC->exportCSV($id);
        return response()->stream($callback, 200, $headers);
    }

    public function csv_raw_result(Response $response, int $id): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        [$callback, $headers] = $this->resultUC->exportRawCSV($id);
        return response()->stream($callback, 200, $headers);
    }

    public function index_q(int $resultId): View
    {
        $questions = $this->resultUC->getFailedQuestionData($resultId);
        return view('export.index_q', compact('questions', 'resultId'));
    }

    public function edit_q(int $resultId, int $id): View
    {
        $question = $this->resultUC->getFailedQuestion($id);
        return view('export.edit_q', compact('question', 'resultId'));
    }

    public function update_q(Request $request, int $resultId, int $id): RedirectResponse
    {
        $status = $this->resultUC->updateFailedQuestion($request, $id);
        return Redirect::route('export.index_q', ['resultId' => $resultId])->with('status', $status);
    }


    public function index_a(int $resultId): View
    {
        $answers = $this->resultUC->getFailedAnswerData($resultId);
        return view('export.index_a', compact('answers', 'resultId'));
    }

    public function edit_a(int $resultId, int $id): View
    {
        $answer = $this->resultUC->getFailedAnswer($id);
        return view('export.edit_a', compact('answer', 'resultId'));
    }

    public function update_a(Request $request, int $resultId, int $id) //: RedirectResponse
    {
        $status = $this->resultUC->updateFailedAnswers($request);
        return Redirect::route('export.index_a', ['resultId' => $resultId])->with('status', $status);
    }

}
