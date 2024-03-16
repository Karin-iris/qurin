<?php

namespace App\UseCases;

use App\QueryServices\ResultQueryService;
use App\Repositories\ResultRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\DataTransferObjects\DataTransferObject;

class ResultUseCase extends UseCase
{
    protected ResultQueryService $resultQS;
    protected ResultRepository $resultR;
    protected DataTransferObject $DTO;

    function __construct()
    {
        $this->resultQS = new ResultQueryService;
        $this->resultR = new ResultRepository;
        $this->DTO = new DataTransferObject;
    }

    public function getData()
    {
        return $this->resultQS->get();

    }
    public function getQuestionData(int $resultId,Request $request){
        return $this->resultQS->getQuestionData($resultId);
    }
    public function getStudentData(int $resultId,Request $request){
        return $this->resultQS->getStudentData($resultId);
    }
    public function getFailedQuestionData(int $resultId)
    {
        return $this->resultQS->getFailedQuestionData($resultId);
    }

    public function getFailedAnswerData(int $resultId)
    {
        return $this->resultQS->getFailedAnswerData($resultId);
    }

    public function getFailedQuestion(int $questionId)
    {
        return $this->resultQS->getFailedQuestion($questionId);
    }

    public function getFailedAnswer(int $answerId)
    {
        return $this->resultQS->getFailedAnswer($answerId);
    }

    public function insertGetId(Request $request)
    {
        $title = $request->input('title');
        return $this->resultR->insertGetId($title);
    }

    public function updateFailedQuestion(Request $request, int $id): string
    {
        $status = $this->resultR->updateFailedQuestion($request, $id);

        //取り込みできなかったQuestionのAnswerを全部取得
        $answers = DB::table('answers')
            ->where('question_id', $id)
            ->whereNull('answer_num')
            ->get();
        foreach ($answers as $answer) {
            $question_row = DB::table('questions')
                ->where('id', $request->input('question_id'))
                ->first();
            $answer_num = NULL;
            if(!empty($question_row)) {
                if ($answer->answer_text == $question_row->correct_choice) {
                    $answer_num = 1;
                }
                if ($answer->answer_text == $question_row->wrong_choice_1) {
                    $answer_num = 2;
                }
                if ($answer->answer_text == $question_row->wrong_choice_2) {
                    $answer_num = 3;
                }
                if ($answer->answer_text == $question_row->wrong_choice_3) {
                    $answer_num = 4;
                }
            }
            $paramArray = array(
                'answer_num' => $answer_num,
            );
            $this->resultR->updateFailedAnswer($paramArray, $answer->id);
        }

        return $status;
    }

    public function updateFailedAnswer(Request $request, int $id): string
    {
        $paramArray = array(
            'answer_num' => $request->input('answer_num'),
        );
        return $this->resultR->updateFailedAnswer($paramArray, $id);
    }

    public function updateFailedAnswers(Request $request): string
    {
        $paramArray = array(
            'result_id' => $request->input('result_id'),
            'answer_text' => $request->input('answer_text'),
            'answer_num' => $request->input('answer_num')
        );
        return $this->resultR->updateFailedAnswers($paramArray);

    }


    public function exportCSV(int $resultId)
    {
        $callback = null;
        $headers = null;
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
            $columns_j = array(
                '',
                ''
            );
            foreach ($questions as $question) {
                $columns_j[] = '第' . $question->order . "問";
            }

            $columns = array(
                'ID',
                'name'
            );
            foreach ($questions as $question) {
                $columns[] = 'a' . sprintf("%05d", $question->question_id);
            }

            $title = "結果";
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename=' . $result->title . '.csv',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];
            $callback = function () use ($questions, $columns, $columns_j, $result) {
                $createCsvFile = fopen('php://output', 'wb');

                mb_convert_variables('SJIS-win', 'UTF-8', $columns_j);
                mb_convert_variables('SJIS-win', 'UTF-8', $columns);
                fputcsv($createCsvFile, $columns_j);
                fputcsv($createCsvFile, $columns);
                $studentData = DB::table('answer_students')
                    ->select(["name", "code", "id"])
                    ->where("result_id", $result->id)
                    ->get();
                foreach ($studentData as $student) {
                    $csv = [];
                    $csv[] = $student->code;
                    $csv[] = Crypt::decryptString($student->name);
                    foreach ($questions as $question) {
                        $answer = DB::table('answers')
                            ->where("student_id", $student->id)
                            ->where("question_id", $question->id)
                            ->where("result_id", $result->id)
                            ->first();
                        if (!empty($answer)) {
                            if ($answer->answer_num) {
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

        }
        return [$callback, $headers];
    }

    public function exportRawCSV(int $resultId)
    {
        $callback = null;
        $headers = null;
        $result = DB::table('results')
            ->where("id", $resultId)
            ->first();
        if ($result) {
            $questions = DB::table('answer_questions')
                ->leftJoin('questions', 'answer_questions.question_id', '=', 'questions.id')
                ->select('answer_questions.id as id', 'answer_questions.order as order',
                    'answer_questions.question_id as question_id',
                    'answer_questions.text as question_text')
                ->where("result_id", $result->id)
                ->orderBy('order')
                ->get();
            $columns_j = array(
                '',
                ''
            );
            foreach ($questions as $question) {
                $columns_j[] = '第' . $question->order . "問";
            }

            $columns = array(
                'ID',
                'name'
            );
            foreach ($questions as $question) {
                $columns[] = 'a' . sprintf("%05d", $question->question_id);
            }

            $title = "結果";
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename=' . $result->title . '_raw.csv',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];
            $callback = function () use ($questions, $columns, $columns_j, $result) {
                $createCsvFile = fopen('php://output', 'wb');

                mb_convert_variables('SJIS-win', 'UTF-8', $columns_j);
                mb_convert_variables('SJIS-win', 'UTF-8', $columns);
                fputcsv($createCsvFile, $columns_j);
                fputcsv($createCsvFile, $columns);
                $studentData = DB::table('answer_students')
                    ->select(["name", "code", "id"])
                    ->where("result_id", $result->id)
                    ->get();
                foreach ($studentData as $student) {
                    $csv = [];
                    $csv[] = Crypt::decryptString($student->name);
                    $csv[] = $student->code;
                    foreach ($questions as $question) {
                        $answer = DB::table('answers')
                            ->where("student_id", $student->id)
                            ->where("question_id", $question->id)
                            ->where("result_id", $result->id)
                            ->first();
                        if (!empty($answer)) {
                            $csv[] = $answer->answer_text;
                        }


                    }
                    mb_convert_variables('SJIS-win', 'UTF-8', $csv);
                    fputcsv($createCsvFile, $csv);
                }
                fclose($createCsvFile);
            };

        }
        return [$callback, $headers];

    }
}
