<?php

namespace App\UseCases;

use App\Http\Requests\QuestionFileRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\Questions\SearchRequest;
use App\Mail\QuestionApproveMail;
use App\Mail\QuestionRemandMail;
use App\Mail\QuestionRequestMail;
use App\Models\Question;
use App\Models\QuestionImage;
use App\QueryServices\QuestionQueryService;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class QuestionUseCase extends UseCase
{

    public Question $question;
    public QuestionImage $question_image;
    public QuestionRepository $questionR;
    public QuestionQueryService $questionQS;
    public array $question_summary_column;
    public array $question_admin_summary_column;

    function __construct()
    {
        $this->question = new Question();
        $this->question_image = new QuestionImage();
        $this->questionR = new QuestionRepository();
        $this->questionQS = new QuestionQueryService();
        $this->question_summary_column = [
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'p.code as p_c_code',
            's.code as s_c_code',
            'c.code as c_code',
            'q.compitency as compitency',
            'q.topic as topic',
            'q.id as id',
            'q.quiz_id as quiz_id',
            'q.is_request as is_request',
            'q.is_approve as is_approve',
            'q.is_remand as is_remand',
            'q.created_at as created_at',
            'q.updated_at as updated_at',
        ];
        $this->question_admin_summary_column = [
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'p.code as p_c_code',
            's.code as s_c_code',
            'c.code as c_code',
            'q.topic as topic',
            'q.section_id as section_id',
            'q.id as id',
            'q.quiz_id as quiz_id',
            'q.user_name as user_name',
            'q.is_request as is_request',
            'q.is_approve as is_approve',
            'q.is_remand as is_remand',
            'q.created_at as created_at',
            'q.updated_at as updated_at',
        ];
    }

    function getData()
    {
        return $this->question->get();
    }

    function getPaginate(Request $request)
    {
        return $this->questionQS->getPaginate($request);
    }

    function getQuestion(int $id): Question
    {
        $question = $this->question->select(
            [
                'p.name as p_c_name',
                's.name as s_c_name',
                'c.name as c_name',
                'p.id as p_c_id',
                's.id as s_c_id',
                'c.id as c_id',
                'q.topic as topic',
                'q.section_id as section_id',
                'q.user_name as user_name',
                'q.compitency as compitency',
                'q.id as id',
                'q.quiz_id as quiz_id',
                'q.text as text',
                'q.correct_choice as correct_choice',
                'q.wrong_choice_1 as wrong_choice_1',
                'q.wrong_choice_2 as wrong_choice_2',
                'q.wrong_choice_3 as wrong_choice_3',
                'q.is_remand as is_remand',
                'q.is_adopt as is_adopt',
                'q.created_at as created_at',
                'q.updated_at as updated_at',
                'q.explanation as explanation'
            ]
        )->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->where('q.id', $id)->firstOrFail();
        $question['images'] = $this->question_image->where('question_id', $id)->get();
        return $question;
    }

    function getUserSummary()
    {
        return $this->question->select(
            ['user_id']
        )->selectRaw('COUNT(q.id) as count_questions')
            ->from('questions as q')->
            groupBy('user_id')->get();
    }

    function getPrimaryCategorySummary()
    {
        return $this->questionQS->getPrimaryCategorySummary();
    }

    function getSecondaryCategorySummary()
    {
        return $this->questionQS->getSecondaryCategorySummary();

    }

    function getCategorySummary()
    {
        return $this->questionQS->getCategorySummary();
    }

    function getQuestions(SearchRequest $request)
    {
        Log::info('Request', $request->all());

        return $this->questionQS->getQuestions($request);
    }

    function getQuestionExport()
    {
        return $this->questionQS->getQuestionExports();
    }

    function getUserQuestion(int $id)
    {
        $question = $this->question->select(
            [
                'p.name as p_c_name',
                's.name as s_c_name',
                'c.name as c_name',
                'p.id as p_c_id',
                's.id as s_c_id',
                'c.id as c_id',
                'q.topic as topic',
                'q.section_id as section_id',
                'q.user_name as user_name',
                'q.compitency as compitency',
                'q.id as id',
                'q.quiz_id as quiz_id',
                'q.text as text',
                'q.correct_choice as correct_choice',
                'q.wrong_choice_1 as wrong_choice_1',
                'q.wrong_choice_2 as wrong_choice_2',
                'q.wrong_choice_3 as wrong_choice_3',
                'q.is_remand as is_remand',
                'q.is_adopt as is_adopt',
                'q.created_at as created_at',
                'q.updated_at as updated_at',
                'q.explanation as explanation'
            ]
        )->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->where('q.id', $id)->firstOrFail();
        $question['images'] = $this->question_image->where('question_id', $id)->paginate(30);
        return $question;
    }

    function getUserQuestions(int $user_id)
    {
        $model = $this->question->select(
            $this->question_summary_column
        )->from('questions as q')
            ->rightJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->rightJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->rightJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->where([['q.user_id', $user_id]]);
        return $model->get();
    }

    function saveQuestion(QuestionRequest $request)
    {
        return $this->questionR->saveQuestion($request);
    }

    function addUserQuestion(QuestionRequest $request): string
    {
        $this->question->fill([
            'topic' => $request->input('topic'),
            'compitency' => $request->input('compitency'),
            'text' => $request->input('text'),
            'quiz_id' => $request->input('quiz_id'),
            'section_id' => $request->input('section_id'),
            'category_id' => $request->input('category_id'),
            'correct_choice' => $request->input('correct_choice'),
            'wrong_choice_1' => $request->input('wrong_choice_1'),
            'wrong_choice_2' => $request->input('wrong_choice_2'),
            'wrong_choice_3' => $request->input('wrong_choice_3'),
            'explanation' => $request->input('explanation'),
            'is_request' => $request->input('is_request'),
            'is_remand' => $request->input('is_remand'),
            'user_id' => Auth::user()->id
        ])->save();
        if ($request->input('is_request') === "1") {
            $status = "request";
            //$this->sendRequestMail($request);
        } else {
            $status = "saved";
        }
        return $status;
    }

    function saveTmpQuestion($id, $text)
    {
        $this->question->insert([
            'id' => $id,
            'text' => $text
        ]);
    }


    function getQuestionsById($request)
    {
        return $this->questionQS->getQuestionsById($request);
    }

    function update(QuestionRequest $request, int $id): string
    {
        return $this->questionR->update($request, $id);
    }

    function updateUserQuestion(QuestionRequest $request, int $id): string
    {
        $this->question->find($id)->fill([
            'topic' => $request->input('topic'),
            'compitency' => $request->input('compitency'),
            'text' => $request->input('text'),
            'section_id' => $request->input('section_id'),
            'quiz_id' => $request->input('quiz_id'),
            'category_id' => $request->input('category_id'),
            'correct_choice' => $request->input('correct_choice'),
            'wrong_choice_1' => $request->input('wrong_choice_1'),
            'wrong_choice_2' => $request->input('wrong_choice_2'),
            'wrong_choice_3' => $request->input('wrong_choice_3'),
            'explanation' => $request->input('explanation'),
            'is_request' => $request->input('is_request'),
            'is_remand' => $request->input('is_remand'),
            'user_id' => Auth::user()->id
        ])->save();
        if ($request->input('is_request') === "1") {
            $status = "request";
            //$this->sendRequestMail($request);
        } else {
            $status = "saved";
        }
        return $status;
    }

    function updateUserQuestionImage(QuestionRequest $request, int $id)
    {
        if ($request->file('image')) {
            $fileObjectArray = $request->file('image');
            $fileIdArray = $request->input('image_id');
            $fileNameArray = [];
            foreach ($fileObjectArray as $key => $fileObject) {
                $ext = $fileObject->getClientOriginalExtension();
                if (in_array($ext, array("jpeg", 'jpg'))) {
                    $dateYmd = date('Ymd');
                    $fileName = $dateYmd . date('His') . sprintf('%03d', rand(0, 999)) . '.' . $ext;
                    $fileNameArray[$key] = $fileName;
                    Storage::disk('public')->putFileAs($dateYmd, $fileObject, $fileNameArray[$key]);
                    if (!empty($fileIdArray[$key])) {
                        $question_image = $this->question_image->find($fileIdArray[$key]);
                    } else {
                        $question_image = $this->question_image;
                    }
                    $question_image->fill([
                        'question_id' => $id,
                        'filepath' => $dateYmd,
                        'filename' => $fileName
                    ])->save();
                }
            }
            return $fileNameArray;
        }

    }

    public function exportQuestionCSV($csv_name = ""): array
    {
        switch ($csv_name) {
            case "swiz":
                $title = "試験問題インポート用リスト_s";
                $columns = array(
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
                );
                break;
            case "pros":
                $title = "試験問題インポート用リスト_p";
                $columns = array(
                    '(※2)問題ID',
                    '講座',
                    'ユニット',
                    'テスト問題カテゴリ',
                    '問題管理コード',
                    '※問題種別',
                    '※解答の任意/必須',
                    '(※1)問題文',
                    '問題ファイル1',
                    '問題ファイル2',
                    '問題ファイル3',
                    '問題ファイル4',
                    '問題ファイル5',
                    '選択肢1',
                    '選択肢2',
                    '選択肢3',
                    '選択肢4',
                    '選択肢5',
                    '選択肢6',
                    '選択肢7',
                    '選択肢8',
                    '選択肢9',
                    '選択肢10',
                    '選択肢11',
                    '選択肢12',
                    '選択肢13',
                    '選択肢14',
                    '選択肢15',
                    '選択肢16',
                    '選択肢17',
                    '選択肢18',
                    '選択肢19',
                    '選択肢20',
                    '選択肢画像1',
                    '選択肢画像2',
                    '選択肢画像3',
                    '選択肢画像4',
                    '選択肢画像5',
                    '選択肢画像6',
                    '選択肢画像7',
                    '選択肢画像8',
                    '選択肢画像9',
                    '選択肢画像10',
                    '選択肢画像11',
                    '選択肢画像12',
                    '選択肢画像13',
                    '選択肢画像14',
                    '選択肢画像15',
                    '選択肢画像16',
                    '選択肢画像17',
                    '選択肢画像18',
                    '選択肢画像19',
                    '選択肢画像20',
                    'ヒント',
                    '(※1)正解',
                    '解説',
                    '解説画像',
                    '備考'
                );
                break;
            case "bunseki":
                $title = "試験問題分析用リスト";
                $columns = array(
                    'QurinID',
                    'QuizID',
                    '試験問題',
                    '正答選択肢',
                    '誤答選択肢１',
                    '誤答選択肢２',
                    '誤答選択肢３',
                    '大分類',
                    '中分類',
                    'セクションID',
                    'セクションタイトル',
                    '採用/不採用',
                    '分析用ID'
                );
                break;
            case "raw":
                $title = "試験問題詳細リスト";
                $columns = array(
                    'QurinID',
                    'QuizID',
                    'SectionID',
                    '',
                    '分類コード',
                    'コンピテンシー',
                    '正答選択肢',
                    '誤答選択肢１',
                    '誤答選択肢２',
                    '誤答選択肢３',
                    '解説'
                );
                break;
            case "syosai":
                $title = "試験問題詳細リスト";
                $columns = array(
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
                );
                break;
            case "topic":
                $title = "試験問題要約リスト";
                $columns = array(
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
                );
                break;
            default:
                $title = "試験問題リスト";
                $columns = array(
                    'QurinID',
                    'QuizID',
                    '試験問題',
                    '正答選択肢',
                    '誤答選択肢１',
                    '誤答選択肢２',
                    '誤答選択肢３',
                    '大分類',
                    '中分類',
                    'セクションID',
                    'セクションタイトル',
                    '採用/不採用'
                );
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $title . '.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        $callback = function () use ($csv_name, $columns) {
            $createCsvFile = fopen('php://output', 'w');

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $questionData = $this->getQuestionExport();

            foreach ($questionData as $question) {
                if ($csv_name === "swiz") {
                    $csv = [
                        $question->section_id,
                        '',
                        '',
                        '',
                        $question->text,
                        '',
                        '#' . $question->id . '#',
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
                }
                if ($csv_name === "pros") {
                    $csv = [
                        $question->quiz_id,
                        '',
                        '',
                        '',
                        $question->id,
                        '選択式',
                        '任意',
                        $question->text,
                        '',
                        '',
                        '',
                        '',
                        '',
                        nl2br($question->correct_choice),
                        nl2br($question->wrong_choice_1),
                        nl2br($question->wrong_choice_2),
                        nl2br($question->wrong_choice_3),
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '1',
                        $question->explanation
                    ];
                }
                if ($csv_name === "raw") {
                    $csv = [
                        $question->id,
                        $question->quiz_id,
                        $question->section_id,
                        '',
                        $question->p_c_code . $question->s_c_code . $question->c_code,
                        $question->compitency,
                        str_replace(array("\r\n", "\r", "\n"), '', $question->text),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->correct_choice),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_1),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_2),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_3),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->explanation)
                    ];
                }
                if ($csv_name === "bunseki") {
                    $csv = [
                        $question->id,
                        $question->quiz_id,
                        $question->text,
                        str_replace(array("\r\n", "\r", "\n"), '', $question->correct_choice),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_1),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_2),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_3),
                        $question->p_c_code,
                        $question->s_c_code,
                        $question->section_id,
                        $question->section_title,
                        $question->is_adopt,
                        "a" . sprintf("%04d", $question->id)
                    ];
                }
                if ($csv_name === "syosai") {
                    $csv = [
                        $question->id,
                        $question->quiz_id,
                        $question->text,
                        str_replace(array("\r\n", "\r", "\n"), '', $question->correct_choice),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_1),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_2),
                        str_replace(array("\r\n", "\r", "\n"), '', $question->wrong_choice_3),
                        $question->explanation,
                        $question->p_c_code,
                        $question->p_c_name,
                        $question->s_c_code,
                        $question->s_c_name,
                        $question->c_code,
                    ];
                }
                if ($csv_name === "topic") {
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
                }
                mb_convert_variables('SJIS-win', 'UTF-8', $csv);
                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };
        return [$callback, $headers];
    }

    function importQuestionCSV(QuestionFileRequest $request, $csv_name)
    {
        $filepath = $request->file('import_file')->getRealPath();
        if (($handle = fopen($filepath, "r")) !== false) {
            // ファイルポインタから行を取得
            $num = 0;
            while ($line = fgets($handle) !== false) {
                $line = mb_convert_encoding($line, 'UTF-8', 'auto');
                $data = explode(",", $line);
                if ($csv_name === "quiz_id") {
                    $c = DB::table('questions')->select(['id'])
                        ->where('text', $data[4])->first();
                    if (!empty($c)) {
                        DB::table('questions')->where('id', $c->id)->update(['quiz_id' => $data[2]]);
                        echo "QurinID" . $c->id . "とQuizID" . $data[2] . "の紐付けに成功しました。<br>";
                    }
                }
                if ($csv_name === "modify") {
                    $c = DB::table('questions')->select([
                        'id',
                        'text',
                        'correct_choice',
                        'wrong_choice_1',
                        'wrong_choice_2',
                        'wrong_choice_3'
                    ])
                        ->where('quiz_id', $data[2])->first();
                    if (!empty($c)) {
                        //print_r($line);
                        if ($c->text !== $data[4]) {
                            echo "QurinID" . $c->id . "の問題文<br>" .
                                "旧" . $c->text . "<br>" .
                                "新" . $data[4] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['text' => $data[4]]);
                        }
                        if ($c->correct_choice !== $data[9]) {
                            echo "QurinID" . $c->id . "の正解選択肢<br>" .
                                "旧" . $c->correct_choice . "<br>" .
                                "新" . $data[9] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['correct_choice' => $data[9]]);
                        }
                        if ($c->wrong_choice_1 !== $data[11]) {
                            echo "QurinID" . $c->id . "の誤答選択肢１<br>" .
                                "旧" . $c->wrong_choice_1 . "<br>" .
                                "新" . $line[11] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_1' => $data[11]]);
                        }
                        if ($c->wrong_choice_2 !== $data[13]) {
                            echo "QurinID" . $c->id . "の誤答選択肢２<br>" .
                                "旧" . $c->wrong_choice_2 . "<br>" .
                                "新" . $line[13] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_2' => $data[13]]);
                        }
                        if ($c->wrong_choice_3 !== $data[15]) {
                            echo "QurinID" . $c->id . "の誤答選択肢３<br>" .
                                "旧" . $c->wrong_choice_3 . "<br>" .
                                "新" . $line[15] . "<br>";
                            DB::table('questions')->where('id', $c->id)->update(['wrong_choice_3' => $line[15]]);
                        }
                    }
                }
                if ($csv_name == "all") {
                    if (!empty($data[0]) && is_numeric($data[0])) {
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
                            ->where('id', $data[0])->first();
                        //print_r($c);
                        if (!empty($c)) {
                            if ($c->text !== $data[3]) {
                                echo "QurinID" . $c->id . "の問題文<br>" .
                                    "旧" . $c->text . "<br>" .
                                    "新" . $data[3] . "<br>";
                                //DB::table('questions')->where('id', $c->id)->update(['text' => $data[3]]);
                            }
                            if ($c->category_id != '999' && !empty($data[8]) && !empty($data[9]) && !empty($data[10])) {
                                $p = DB::table('categories as c')->select(['c.id'])
                                    ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
                                    ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
                                    ->where([
                                        ['p.code', "=", $data[8]],
                                        ['s.code', "=", sprintf("%02d", $data[9])],
                                        ['c.code', "=", sprintf("%02d", $data[10])]
                                    ])
                                    ->first();
                                if (!empty($p)) {
                                    DB::table('questions')->where('id', $c->id)->update(['category_id' => $p->id]);
                                }
                            }
                            if ($c->quiz_id == null) {
                                if (!empty($data[1])) {
                                    DB::table('questions')->where('id', $c->id)->update(['quiz_id' => $data[1]]);
                                }
                            }
                            /*}else {
                                //$this->questionUC->saveTmpQuestion($data[0],$data[3]);
                                echo $data[0];
                                DB::table('questions')->insert(['id' => $data[0],
                                    'text' => $data[3],
                                    'category_id' => "999",
                                    'topic' => "",
                                    'compitency' => "9",
                                    'user_name' => 'test',
                                    'correct_choice' => $data[4],
                                    'wrong_choice_1' => $data[5],
                                    'wrong_choice_2' => $data[6],
                                    'wrong_choice_3' => $data[7],
                                    'explanation' => '',
                                    'is_request' => 0,
                                    'is_remand' => 0,
                                ]);
                            */
                        }
                    }
                }
                if ($csv_name == "raw") {
                    if ($num !== 0) {
                        if (!empty($data[6])) {
                            $c = DB::table('questions')->select(['id'])
                                ->where('text', $data[6])->first();
                        }

                        if (empty($c) && !empty($data[4])) {
                            $p_category_id = "";
                            $s_category_id = "";
                            $category_id = "999";
                            $p_category = DB::table('primary_categories')->select(['id'])
                                ->where('code', substr($data[4], 0, 2))->first();
                            if ($p_category) {
                                $p_category_id = $p_category->id;
                                $s_category = DB::table('secondary_categories')->select(['id'])
                                    ->where('primary_id', $p_category_id)
                                    ->where('code', sprintf('%02d', substr($data[4], 2, 1)))
                                    ->first();
                                if ($s_category) {
                                    $s_category_id = $s_category->id;
                                    $category = DB::table('categories')->select(['id'])
                                        ->where('secondary_id', $s_category_id)
                                        ->where('code', sprintf('%02d', substr($data[4], 4, 1)))
                                        ->first();
                                    if ($category) {
                                        $category_id = $category->id;
                                    }
                                }
                            }
                            DB::table('questions')->insert(
                                [
                                    'category_id' => $category_id,
                                    'topic' => $data[6],
                                    'text' => $data[6],
                                    'compitency' => str_replace("レベル", "", $data[5]),
                                    'correct_choice' => $data[7],
                                    'wrong_choice_1' => $data[8],
                                    'wrong_choice_2' => $data[9],
                                    'wrong_choice_3' => $data[10],
                                    'explanation' => $data[11],
                                    'is_approve' => 1
                                ]
                            );
                        }
                    }
                }
                if ($csv_name == "explain") {
                    $c = DB::table('questions')->select(['id'])
                        ->where('id', $data[0])->first();
                    if ($num !== 0 && !empty($data[0]) && is_numeric($data[0])) {
                        if (!empty($data[3])) {
                            DB::table('questions')->where('id', $c->id)->update(['explanation' => $data[3]]);
                        }
                    }
                }
                if ($csv_name == "topic") {
                    $c = DB::table('questions')->select(['id'])
                        ->where('id', $data[0])->first();
                    if ($num !== 0 && !empty($data[1]) && is_numeric($data[0])) {
                        if (!empty($data[1])) {
                            DB::table('questions')->where('id', $c->id)->update(['topic' => $data[1]]);
                        }
                    }
                }
                $num++;
            }
            fclose($handle);
        }
    }

    function delQuestion($id)
    {
        $this->question->find($id)->delete();
    }

    function delUserQuestion($id)
    {
        $this->question->find($id)->delete();
    }

    function sendRequestMail(QuestionRequest $request)
    {
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new QuestionRequestMail($name, $email));
    }

    function sendApprovalMail(QuestionRequest $request)
    {
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new QuestionApproveMail($name, $email));
    }

    function sendRemandMail(QuestionRequest $request)
    {
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new QuestionRemandMail($name, $email));
    }
}
