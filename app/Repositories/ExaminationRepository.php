<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Examination;
use App\Http\Requests\Examinations\ExaminationRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ExaminationRepository extends Repository
{
    protected Examination $examination;

    public function __construct()
    {
        $this->examination = new Examination;
    }

    public function add(ExaminationRequest $request)
    {
        try {
            $user = $this->examination::create([
                'title' => $request->input('title'),
                'topic' => $request->input('topic'),
                'gpt_prompt' => $request->input('gpt_prompt'),
                'explanation' => $request->input('explanation')
            ]);
            return "saved";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in createQuestion: " . $e->getMessage());
            return "error";
        }
    }

    public function update(ExaminationRequest $request, int $id)
    {
        try {
            $user = $this->examination::find($id)->fill([
                'title' => $request->input('title'),
                'topic' => $request->input('topic'),
                'gpt_prompt' => $request->input('gpt_prompt'),
                'explanation' => $request->input('explanation'),
            ])->save();
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateQuestion: " . $e->getMessage());
            return "error";
        }
    }

    public function del(int $id)
    {


    }
    // 成功した場合、作成したユーザーの情報を返す

}
