<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Examination;
use App\Http\Requests\Examinations\ExaminationRequest;

class ExaminationRepository extends Repository
{
    protected Examination $examination;
    function __construct(){
        $this->examination = new Examination;
    }
    function set(ExaminationRequest $request)
    {
        try {
            // ユーザーの作成
            $user = $this->examination::create([
                'title' => $request->input('title'),
                'topic' => $request->input('topic')
            ]);
            //return response()->json(['user' => $user], 201);
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            return response()->json(['error' => 'Database error occurred'], 500);
        }
    }


    // 成功した場合、作成したユーザーの情報を返す

}
