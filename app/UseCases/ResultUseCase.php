<?php

namespace App\UseCases;

use App\QueryServices\ResultQueryService;
use App\Repositories\ResultRepository;

use Illuminate\Support\Facades\DB;

class ResultUseCase extends UseCase
{
    protected ResultQueryService $resultQS;
    protected ResultRepository $resultR;

    function __construct()
    {
        $this->resultQS = new ResultQueryService;
        $this->resultR = new ResultRepository;
    }

    function getData()
    {
        return $this->resultQS->get();

    }

    public function getFailedQuestionData(int $resultId)
    {
        return $this->resultQS->getFailedQuestionData($resultId);
    }

    public function getFailedQuestion(int $questionId)
    {
        return $this->resultQS->getFailedQuestion($questionId);
    }

    public function updateFailedQuestion(){

    }
    public function exportCSV(int $resultId)
    {
        $result = DB::table('results')
            ->where("id", $resultId)
            ->first();
        if ($result) {
            $questions = DB::table('answer_questions')
                ->leftJoin('questions', 'answer_questions.question_id', '=', 'questions.id')
                ->select('answer_questions.id as id', 'answer_questions.order as order',
                    'answer_questions.question_id as question_id')
                ->where("result_id", $result->id)
                ->orderBy('order')
                ->get();
            $columns = array(
                'Student_id'
            );
            foreach ($questions as $question) {
                $columns[] = 'a' . sprintf("%05d", $question->question_id);
            }

            $title = "結果";
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename=' . $title . '.csv',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];
            $callback = function () use ($questions, $columns, $result) {
                $createCsvFile = fopen('php://output', 'w');

                mb_convert_variables('SJIS-win', 'UTF-8', $columns);

                fputcsv($createCsvFile, $columns);
                $studentData = DB::table('answer_students')
                    ->select(["name", "id"])
                    ->where("result_id", $result->id)
                    ->get();
                foreach ($studentData as $student) {
                    $csv = [];
                    $csv[] = $student->name;

                    foreach ($questions as $question) {
                        $answer = DB::table('answers')
                            ->where("student_id", $student->id)
                            ->where("question_id", $question->id)
                            ->where("result_id", $result->id)
                            ->first();
                        if (!empty($answer)) {
                            if (!empty($answer->answer_num)) {
                                $csv[] = $answer->answer_num;
                            } else {
                                $csv[] = $answer->answer_text;
                            }
                        }


                    }
                    mb_convert_variables('SJIS-win', 'UTF-8', $csv);
                    fputcsv($createCsvFile, $csv);
                }
                fclose($createCsvFile);
            };
            return [$callback, $headers];
        }


    }
}
