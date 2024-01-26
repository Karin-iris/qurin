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

class ExportController extends Controller
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
        return view('export.index');
    }

    public function csv(Response $response)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=試験問題リスト.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        $callback = function () {
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'SectionID',
                'Section Row Index',
                'Quiz ID',
                '形式',
                '問題文',
                'スコア',
                '解説（任意）',
                '追加の選択肢（任意）',
                '選択肢の順番をランダムにする',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
                'Select Quiz Option Content',
                'Select Quiz Option Correct',
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $questions = DB::table('questions');

            $questionData = $questions
                ->select(['id', 'text', 'correct_choice', 'wrong_choice_1', 'wrong_choice_2', 'wrong_choice_3'])
                ->where('is_approve', 1)->get();

            foreach ($questionData as $question) {
                $csv = [
                    '',
                    '',
                    '',
                    '',
                    $question->text,
                    '',
                    '#'.$question->id.'#',
                    '',
                    'true',
                    nl2br($question->correct_choice),
                    'true',
                    nl2br($question->wrong_choice_1),
                    'false',
                    nl2br($question->wrong_choice_2),
                    'false',
                    nl2br($question->wrong_choice_3),
                    'false'
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };
        //return \Maatwebsite\Excel\Facades\Excel::download(\App\Models\Question::all(), 'users.xlsx');
        return response()->stream($callback, 200, $headers);

    }
    public function csv_learning(Response $response)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=試験問題分析用リスト.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        $callback = function () {
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'QurinID',
                'QuizID',
                '試験問題',
                '正答選択肢',
                '誤答選択肢１',
                '誤答選択肢２',
                '誤答選択肢３',
                '大分類',
                '中分類',
                'セクションID'
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $questions = DB::table('questions');

            $questionData = $this->questionUC->getQuestionExports();

            foreach ($questionData as $question) {
                $csv = [
                    $question->id,
                    $question->quiz_id,
                    $question->text,
                    str_replace(array("\r\n", "\r", "\n"),'', $question->correct_choice),
                    str_replace(array("\r\n", "\r", "\n"),'',$question->wrong_choice_1),
                    str_replace(array("\r\n", "\r", "\n"),'',$question->wrong_choice_2),
                    str_replace(array("\r\n", "\r", "\n"),'',$question->wrong_choice_3),
                    $question->p_c_code,
                    $question->s_c_code,
                    $question->section_id
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };
        //return \Maatwebsite\Excel\Facades\Excel::download(\App\Models\Question::all(), 'users.xlsx');
        return response()->stream($callback, 200, $headers);

    }
    public function csv_explanation(Response $response)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=試験問題詳細リスト.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        $callback = function () {
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'QurinID',
                'QuizID',
                '試験問題',
                '正答選択肢',
                '誤答選択肢１',
                '誤答選択肢２',
                '誤答選択肢３',
                '解説',
                '大分類コード',
                '大分類',
                '中分類コード',
                '中分類',
                '小分類コード',
                '小分類'
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $questions = DB::table('questions');

            $questionData = $this->questionUC->getQuestionExportDetail();

            foreach ($questionData as $question) {
                $csv = [
                    $question->id,
                    $question->quiz_id,
                    $question->text,
                    str_replace(array("\r\n", "\r", "\n"),'', $question->correct_choice),
                    str_replace(array("\r\n", "\r", "\n"),'',$question->wrong_choice_1),
                    str_replace(array("\r\n", "\r", "\n"),'',$question->wrong_choice_2),
                    str_replace(array("\r\n", "\r", "\n"),'',$question->wrong_choice_3),
                    $question->explanation,
                    $question->p_c_code,
                    $question->p_c_name,
                    $question->s_c_code,
                    $question->s_c_name,
                    $question->c_code,
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };
        //return \Maatwebsite\Excel\Facades\Excel::download(\App\Models\Question::all(), 'users.xlsx');
        return response()->stream($callback, 200, $headers);

    }

    public function csv_topic(Response $response)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=試験問題要約リスト.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        $callback = function () {
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'QurinID',
                'QuizID',
                '試験問題',
                '要約',
                '大分類コード',
                '大分類',
                '中分類コード',
                '中分類',
                '小分類コード',
                '小分類'
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $questions = DB::table('questions');

            $questionData = $this->questionUC->getQuestionExportDetail();

            foreach ($questionData as $question) {
                $csv = [
                    $question->id,
                    $question->quiz_id,
                    $question->text,
                    $question->topic,
                    $question->p_c_code,
                    $question->p_c_name,
                    $question->s_c_code,
                    $question->s_c_name,
                    $question->c_code,
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };
        //return \Maatwebsite\Excel\Facades\Excel::download(\App\Models\Question::all(), 'users.xlsx');
        return response()->stream($callback, 200, $headers);

    }

    function import(){
        return view('question.import'
        );
    }
    function import_csv(QuestionFileRequest $request){
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== FALSE) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($num !== 0) {
                    $c = DB::table('questions')->select(['id'])
                        ->where('text', $line[4])->first();
                    if (!empty($c)) {
                        DB::table('questions')->where('id', $c->id)->update(['quiz_id' => $line[2]]);
                        echo "QurinID".$c->id."とQuizID".$line[2]."の紐付けに成功しました。<br>";
                    }
                }
                $num++;
            }
            fclose($handle);
        }
        //var_dump($records);
    }

    function modify_import(){
        return view('question.modify_import'
        );
    }

    function modify_import_csv(QuestionFileRequest $request){
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== FALSE) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($num !== 0) {
                    $c = DB::table('questions')->select(['id','text','correct_choice','wrong_choice_1','wrong_choice_2','wrong_choice_3'])
                        ->where('quiz_id', $line[2])->first();
                    if (!empty($c)) {
                        //print_r($line);
                        if($c->text !== $line[4]){
                            echo "QurinID".$c->id."の問題文<br>".
                                "旧".$c->text."<br>".
                                "新".$line[4]."<br>";
                            DB::table('questions')->where('id', $c->id)->update(['text' => $line[4]]);
                        }
                        if($c->correct_choice !== $line[9]){
                            echo "QurinID".$c->id."の正解選択肢<br>".
                                "旧".$c->correct_choice."<br>".
                                "新".$line[9]."<br>";
                            DB::table('questions')->where('id', $c->id)->update(['correct_choice' => $line[9]]);
                        }
                        if($c->wrong_choice_1 !== $line[11]){
                            echo "QurinID".$c->id."の誤答選択肢１<br>".
                            "旧".$c->wrong_choice_1."<br>".
                            "新".$line[11]."<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_1' => $line[11]]);
                        }
                        if($c->wrong_choice_2 !== $line[13]){
                            echo "QurinID".$c->id."の誤答選択肢２<br>".
                                "旧".$c->wrong_choice_2."<br>".
                                "新".$line[13]."<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_2' => $line[13]]);
                        }
                        if($c->wrong_choice_3 !== $line[15]){
                            echo "QurinID".$c->id."の誤答選択肢３<br>".
                                "旧".$c->wrong_choice_3."<br>".
                                "新".$line[15]."<br>";
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

    function all_import(){
        return view('question.all_import'
        );
    }

    function all_import_csv(QuestionFileRequest $request){
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== FALSE) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if($num !== 0 && !empty($line[0]) && is_numeric($line[0])) {
                    //print_r($line);
                    $c = DB::table('questions')->select(['id','quiz_id','category_id','topic','text','correct_choice','wrong_choice_1','wrong_choice_2','wrong_choice_3'])
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
                                ->where([['p.code',"=",$line[8]],['s.code',"=",sprintf("%02d",$line[9])],['c.code',"=",sprintf("%02d",$line[10])]])
                                ->first();
                            if(!empty($p)){
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

    function explain_import(){
        return view('question.explain_import');
    }

    function explain_import_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== FALSE) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
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

    function topic_import(){
        return view('question.topic_import');
    }

    function topic_import_csv(QuestionFileRequest $request)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== FALSE) {
            // ファイルポインタから行を取得
            $num = 0;
            while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
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
    function question_update_from_bk(){

    }
}
