<?php

namespace App\Repositories;

use App\Http\Requests\Sections\SectionRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Section;
use Illuminate\Support\Facades\Log;

class SectionRepository extends Repository
{
    protected Section $section;

    public function __construct()
    {
        $this->section = new Section;
    }

    public function add(SectionRequest $request): string
    {
        try {
            $section = $this->section::create([
                'title' => $request->input('title'),
                'topic' => $request->input('topic'),
                'is_case' => $request->input('is_case'),
                'case_text' => $request->input('case_text')
            ]);
            return "saved";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateQuestion: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function update(SectionRequest $request, int $id): string
    {
        try {
            $section = $this->section::find($id)->fill([
                'sec_id' => $request->input('sec_id'),
                'title' => $request->input('title'),
                'topic' => $request->input('topic'),
                'is_case' => $request->input('is_case'),
                'is_default' => $request->input('is_default'),
                'case_text' => strip_tags($request->input('case_text'))
            ])->save();
            return "updated";
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            Log::error("An error occurred in updateQuestion: " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }
}
