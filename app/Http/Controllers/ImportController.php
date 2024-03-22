<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionFileRequest;
use App\Models\Question;
use App\UseCases\CategoryUseCase;
use App\UseCases\QuestionUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use JetBrains\PhpStorm\Pure;

class ImportController extends Controller
{
    public $categoryUC;
    public $questionUC;

    public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
        $this->questionUC = new QuestionUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('import.index');
    }


    function import()
    {
        return view('import.import');
    }

    function import_csv(QuestionFileRequest $request)
    {
        $this->questionUC->importQuestionCSV($request, 'quiz_id');
    }

    function import_raw()
    {
        return view('import.import_raw');
    }

    function import_raw_csv(QuestionFileRequest $request)
    {
        $this->questionUC->importQuestionCSV($request, 'raw');
    }

    function modify_import()
    {
        return view('import.modify_import'
        );
    }

    function modify_import_csv(QuestionFileRequest $request)
    {
        $this->questionUC->importQuestionCSV($request, 'modify');
    }

    function all_import()
    {
        return view('import.all_import'
        );
    }

    function all_import_csv(QuestionFileRequest $request)
    {
        $this->questionUC->importQuestionCSV($request, 'all');
    }

    function explain_import()
    {
        return view('import.explain_import');
    }

    function explain_import_csv(QuestionFileRequest $request)
    {
        $this->questionUC->importQuestionCSV($request, 'explain');
    }

    function topic_import()
    {
        return view('import.topic_import');
    }

    function topic_import_csv(QuestionFileRequest $request)
    {
        $this->questionUC->importQuestionCSV($request, 'topic');
    }

    function import_result()
    {
        return view('import.result_import');
    }

    function import_result_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            if ($request->input("title")) {
                $title = $request->input("title");
            } else {
                $title = "結果";
            }
            $result_id = DB::table('results')->insertGetId([
                'title' => $title,
            ]);
            // ファイルポインタから行を取得
            $num = 0;
            $row = 0;
            $question = [];
            while (($line = fgets($handle)) !== false) {
                $line = mb_convert_encoding($line, 'UTF-8', 'auto');
                $data = explode(",", $line);
                $order = 1;
                if ($row === 1) {

                    for ($i = 16; $i <= 275; $i += 4) {
                        $qurin_question = DB::table('questions')
                            ->where('text', $data[$i])
                            ->orWhereRaw('substr(text,0,10) = ?', mb_substr($data[$i], 0, 10))
                            ->first();
                        if ($qurin_question) {
                            $qurin_question_id = $qurin_question->id;
                        } else {
                            $qurin_question_id = null;
                        }
                        $count = DB::table('answer_questions')
                            ->where('text', $data[$i])
                            ->where('result_id', $result_id)
                            ->count();
                        if ($count === 0) {
                            DB::table('answer_questions')->insert([
                                'text' => $data[$i],
                                'question_id' => $qurin_question_id,
                                'result_id' => $result_id,
                                'order' => $order,
                            ]);
                        }
                        $order++;
                    }
                }
                if ($row > 0) {
                    if (array_key_exists(1, $data) && !empty($data[1])) {
                        $name = Crypt::encryptString($data[1]);
                    } else {
                        $name = "";
                    }
                    $student = DB::table('answer_students')
                        ->where('name', $name)
                        ->where('code', $data[0])
                        ->where('result_id', $result_id)
                        ->first();
                    if (!empty($student)) {
                        $student_id = $student->id;
                    } else {
                        $student_id = DB::table('answer_students')->insertGetId([
                            'name' => $name,
                            'code' => $data[0],
                            'result_id' => $result_id,
                        ]);
                    }

                    for ($i = 17; $i <= 275; $i += 4) {
                        $j = $i - 1;
                        $question = DB::table('answer_questions')
                            ->where('text', $data[$j])
                            ->where('result_id', $result_id)
                            ->first();

                        if (!empty($question)) {
                            $answer_num = null;
                            if ($question->question_id) {
                                $question_row = DB::table('questions')
                                    ->where('id', $question->question_id)
                                    ->first();
                                /*
                                $correct_choice = DB::table('questions')
                                    ->where('correct_choice', $data[$i])
                                    ->count();*/

                                /*$wrong_choice_1 = DB::table('questions')
                                    ->where('wrong_choice_1', $data[$i])
                                    ->count();*/
                                /*$wrong_choice_2 = DB::table('questions')
                                    ->where('wrong_choice_2', $data[$i])
                                    ->count();*/
                                /*$wrong_choice_3 = DB::table('questions')
                                    ->where('wrong_choice_3', $data[$i])
                                    ->count();*/
                                /*if($wrong_choice_3){
                                    $answer_num = 4;
                                }*/
                                similar_text($data[$i], $question_row->correct_choice, $correct_percent);
                                if ($correct_percent > 90) {
                                    $answer_num = 1;
                                }
                                if ($data[$i] == $question_row->wrong_choice_1) {
                                    $answer_num = 2;
                                }
                                if ($data[$i] == $question_row->wrong_choice_2) {
                                    $answer_num = 3;
                                }
                                if ($data[$i] == $question_row->wrong_choice_3) {
                                    $answer_num = 4;
                                }
                            }

                            DB::table('answers')->insert([
                                'result_id' => $result_id,
                                'student_id' => $student_id,
                                'question_id' => $question->id,
                                'text' => $data[$j],
                                'answer_num' => $answer_num,
                                'answer_text' => $data[$i]
                            ]);
                        }
                    }
                }

                /*if ($num !== 0 && !empty($line[1]) && is_numeric($line[0])) {
                    if (!empty($line[1])) {
                        DB::table('questions')->where('id', $c->id)->update(['topic' => $line[1]]);
                    }
                }*/
                $num++;
                $row++;
            }
        }
        return Redirect::route('import.index');
    }

    function import_finalresult()
    {
        return view('import.finalresult_import');
    }

    function import_finalresult_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            /*if ($request->input("title")) {
                $title = $request->input("title");
            } else {
                $title = "結果";
            }
            $result_id = DB::table('results')->insertGetId([
                'title' => $title,
            ]);
            // ファイルポインタから行を取得
            $num = 0;

            $question = [];*/
            $row = 0;
            $result_id = 12;
            while (($line = fgets($handle)) !== false) {
                $line = mb_convert_encoding($line, 'UTF-8', 'auto');
                $data = explode(",", $line);
                $student = DB::table('answer_students')
                    //->where('name', $data[3])
                    ->where('code', $data[1])
                    ->where('result_id', $result_id)
                    ->first();
                print_r($student);
                if (!empty($student)) {
                    DB::table('answer_students')
                        ->where('id', $student->id)
                        ->update([
                            'score' => $data[7],
                            'score_count' => $data[4],
                            'is_passed' => $data[8] == "合格" ? 1 : 0,
                            'exam_code' => $data[2],
                            'pos'=> $data[0]
                        ]);
                }
                //print_r($data);
                $row++;
            }
        }
        //return Redirect::route('import.index');
        exit();
    }

    function question_update_from_bk()
    {

    }
}
