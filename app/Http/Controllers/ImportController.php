<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCaseRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionFileRequest;
use App\Models\Question;
use App\UseCases\CategoryUseCase;
use App\UseCases\QuestionUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use JetBrains\PhpStorm\Pure;
use Maatwebsite\Excel\Facades\Excel;

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

    function import_raw()
    {
        return view('import.import_raw');
    }

    function import()
    {
        return view('import.import');
    }

    function import_raw_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 100000, ",")) !== false) {
                if ($num !== 0) {

                    $c = DB::table('questions')->select(['id'])
                        ->where('text', $line[6])->first();

                    if (empty($c)) {
                        $category_id = "999";
                        $p_category = DB::table('primary_categories')->select(['id'])
                            ->where('code', substr($line[4], 0, 2))->first();
                        if ($p_category) {
                            $p_category_id = $p_category->id;
                            $s_category = DB::table('secondary_categories')->select(['id'])
                                ->where('primary_id', $p_category_id)
                                ->where('code', sprintf('%02d', substr($line[4], 2, 1)))
                                ->first();
                            if ($s_category) {
                                $s_category_id = $s_category->id;
                                $category = DB::table('categories')->select(['id'])
                                    ->where('secondary_id', $p_category_id)
                                    ->where('code', sprintf('%02d', substr($line[4], 4, 1)))
                                    ->first();
                                if ($category) {
                                    $category_id = $category->id;
                                }
                            }
                            echo $p_category_id . $s_category_id . $category_id;
                        }
                        DB::table('questions')->insert(
                            [
                                'category_id' => $category_id,
                                'topic' => $line[6],
                                'text' => $line[6],
                                'compitency' => str_replace("レベル", "", $line[5]),
                                'correct_choice' => $line[7],
                                'wrong_choice_1' => $line[8],
                                'wrong_choice_2' => $line[9],
                                'wrong_choice_3' => $line[10],
                                'explanation' => $line[11],
                                'is_approve' => 1
                            ]
                        );
                        echo $line[6] . "<br>";
                    }

                }
                $num++;
            }
            fclose($handle);
        }
        //var_dump($records);
    }

    function import_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
                if ($num !== 0) {
                    $c = DB::table('questions')->select(['id'])
                        ->where('text', $line[4])->first();
                    if (!empty($c)) {
                        DB::table('questions')->where('id', $c->id)->update(['quiz_id' => $line[2]]);
                        echo "QurinID" . $c->id . "とQuizID" . $line[2] . "の紐付けに成功しました。<br>";
                    }
                }
                $num++;
            }
            fclose($handle);
        }
        //var_dump($records);
    }

    function modify_import()
    {
        return view('import.modify_import'
        );
    }

    function modify_import_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
                if ($num !== 0) {
                    $c = DB::table('questions')->select([
                        'id',
                        'text',
                        'correct_choice',
                        'wrong_choice_1',
                        'wrong_choice_2',
                        'wrong_choice_3'
                    ])
                        ->where('quiz_id', $line[2])->first();
                    if (!empty($c)) {
                        //print_r($line);
                        if ($c->text !== $line[4]) {
                            echo "QurinID" . $c->id . "の問題文<br>" .
                                "旧" . $c->text . "<br>" .
                                "新" . $line[4] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['text' => $line[4]]);
                        }
                        if ($c->correct_choice !== $line[9]) {
                            echo "QurinID" . $c->id . "の正解選択肢<br>" .
                                "旧" . $c->correct_choice . "<br>" .
                                "新" . $line[9] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['correct_choice' => $line[9]]);
                        }
                        if ($c->wrong_choice_1 !== $line[11]) {
                            echo "QurinID" . $c->id . "の誤答選択肢１<br>" .
                                "旧" . $c->wrong_choice_1 . "<br>" .
                                "新" . $line[11] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_1' => $line[11]]);
                        }
                        if ($c->wrong_choice_2 !== $line[13]) {
                            echo "QurinID" . $c->id . "の誤答選択肢２<br>" .
                                "旧" . $c->wrong_choice_2 . "<br>" .
                                "新" . $line[13] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_2' => $line[13]]);
                        }
                        if ($c->wrong_choice_3 !== $line[15]) {
                            echo "QurinID" . $c->id . "の誤答選択肢３<br>" .
                                "旧" . $c->wrong_choice_3 . "<br>" .
                                "新" . $line[15] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_3' => $line[15]]);
                        }
                    }
                }
                $num++;
            }
            fclose($handle);
        }
        //var_dump($records);
    }

    function all_import()
    {
        return view('import.all_import'
        );
    }

    function all_import_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {

                if ($num !== 0 && !empty($line[0]) && is_numeric($line[0])) {
                    //print_r($line);
                    $c = DB::table('questions')->select([
                        'id',
                        'quiz_id',
                        'category_id',
                        'topic',
                        'text',
                        'correct_choice',
                        'wrong_choice_1',
                        'wrong_choice_2',
                        'wrong_choice_3'
                    ])
                        ->where('id', $line[0])->first();
                    //print_r($c);
                    if (!empty($c)) {
                        //print_r($line);
                        if ($c->text !== $line[3]) {
                            echo "QurinID" . $c->id . "の問題文<br>" .
                                "旧" . $c->text . "<br>" .
                                "新" . $line[3] . "<br>";
                            //DB::table('questions')->where('id', $c->id)->update(['text' => $line[3]]);
                        }
                        if ($c->category_id != '999' && !empty($line[8]) && !empty($line[9]) && !empty($line[10])) {
                            $p = DB::table('categories as c')->select(['c.id'])
                                ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
                                ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
                                ->where([
                                    ['p.code', "=", $line[8]],
                                    ['s.code', "=", sprintf("%02d", $line[9])],
                                    ['c.code', "=", sprintf("%02d", $line[10])]
                                ])
                                ->first();
                            if (!empty($p)) {
                                DB::table('questions')->where('id', $c->id)->update(['category_id' => $p->id]);
                            }
                        }
                        if ($c->quiz_id == null) {
                            if (!empty($line[1])) {
                                DB::table('questions')->where('id', $c->id)->update(['quiz_id' => $line[1]]);
                            }
                        }
                        /*}else {
                            //$this->questionUC->saveTmpQuestion($line[0],$line[3]);
                            echo $line[0];
                            DB::table('questions')->insert(['id' => $line[0],
                                'text' => $line[3],
                                'category_id' => "999",
                                'topic' => "",
                                'compitency' => "9",
                                'user_name' => 'test',
                                'correct_choice' => $line[4],
                                'wrong_choice_1' => $line[5],
                                'wrong_choice_2' => $line[6],
                                'wrong_choice_3' => $line[7],
                                'explanation' => '',
                                'is_request' => 0,
                                'is_remand' => 0,
                            ]);
                        */
                    }
                }
                $num++;
            }
            fclose($handle);
        }
        //var_dump($records);
    }

    function explain_import()
    {
        return view('import.explain_import');
    }

    function explain_import_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
                $c = DB::table('questions')->select(['id'])
                    ->where('id', $line[0])->first();
                if ($num !== 0 && !empty($line[0]) && is_numeric($line[0])) {
                    if (!empty($line[3])) {
                        DB::table('questions')->where('id', $c->id)->update(['explanation' => $line[3]]);
                    }
                }
                $num++;
            }
        }
    }

    function topic_import()
    {
        return view('import.topic_import');
    }

    function topic_import_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
                $c = DB::table('questions')->select(['id'])
                    ->where('id', $line[0])->first();
                if ($num !== 0 && !empty($line[1]) && is_numeric($line[0])) {
                    if (!empty($line[1])) {
                        DB::table('questions')->where('id', $c->id)->update(['topic' => $line[1]]);
                    }
                }
                $num++;
            }
        }
    }

    function import_result()
    {
        return view('import.result_import');
    }

    function import_result_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {

            // ファイルポインタから行を取得
            $num = 0;
            $row = 0;
            $question = [];
            while (($line = fgets($handle)) !== false) {
                $line = mb_convert_encoding($line, 'UTF-8', 'auto');
                $data = explode(",", $line);
                $order=1;
                if ($row === 1) {

                    for ($i = 16; $i <= 275; $i += 4) {
                        $qurin_question = DB::table('questions')
                            ->where('text', $data[$i])
                            ->orWhereRaw('replace(text,"\n","") = ?', $data[$i])
                            ->first();
                        if($qurin_question){
                            $qurin_question_id = $qurin_question->id;
                        }else{
                            $qurin_question_id = null;
                        }
                        $count = DB::table('answer_questions')
                            ->where('text', $data[$i])
                            ->count();
                        if($count === 0){
                            DB::table('answer_questions')->insert([
                                'text' => $data[$i],
                                'question_id' => $qurin_question_id,
                                'order' => $order,
                            ]);
                        }
                        $order++;
                    }
                }
                if ($row > 0) {
                    $student = DB::table('answer_students')
                        ->where('name', $data[0])
                        ->first();
                    if(!empty($student)) {
                        $student_id = $student->id;
                    }else{
                        $student_id = DB::table('answer_students')->insertGetId([
                            'name' => $data[0]
                        ]);
                    }

                    for ($i = 17; $i <= 275; $i += 4) {
                        $j = $i - 1;
                        $question = DB::table('answer_questions')
                            ->where('text', $data[$j])
                            ->first();

                        if(!empty($question)){
                            $answer_num = null;
                            if($question->question_id){
                                $question_row = DB::table('questions')
                                    ->where('id', $question->question_id)
                                    ->first();
                                /*
                                $correct_choice = DB::table('questions')
                                    ->where('correct_choice', $data[$i])
                                    ->count();*/
                                similar_text($data[$i],$question_row->correct_choice,$correct_percent);
                                if($correct_percent > 90){
                                    $answer_num = 1;
                                }
                                /*$wrong_choice_1 = DB::table('questions')
                                    ->where('wrong_choice_1', $data[$i])
                                    ->count();*/
                                similar_text($data[$i],$question_row->wrong_choice_1,$correct_percent);

                                if($wrong_choice_1){
                                    $answer_num = 2;
                                }
                                $wrong_choice_2 = DB::table('questions')
                                    ->where('wrong_choice_2', $data[$i])
                                    ->count();
                                if($wrong_choice_2){
                                    $answer_num = 3;
                                }
                                $wrong_choice_3 = DB::table('questions')
                                    ->where('wrong_choice_3', $data[$i])
                                    ->count();
                                if($wrong_choice_3){
                                    $answer_num = 4;
                                }
                            }

                            DB::table('answers')->insert([
                                'student_id' => $student_id,
                                'question_id' => $question->id,
                                'text' => $data[$j],
                                'answer_num'=> $answer_num,
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
    }

    function question_update_from_bk()
    {

    }
}
