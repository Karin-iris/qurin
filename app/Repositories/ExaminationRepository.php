<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Examination;
use App\Http\Requests\Examinations\ExaminationRequest;
use Illuminate\Database\QueryException;

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
            return response()->json(['user' => $user], 201);
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            return response()->json(['error' => 'Database error occurred'], 500);
        }
    }

    function mod(ExaminationRequest $request,int $id)
    {
        try {
            // ユーザーの作成
            $user = $this->examination::find($id)->fill([
                'title' => $request->input('title'),
                'topic' => $request->input('topic')
            ])->save();
            return response()->json(['user' => $user], 201);
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            return response()->json(['error' => 'Database error occurred'], 500);
        }
    }

    function del(int $id){

    }
    // 成功した場合、作成したユーザーの情報を返す

}
