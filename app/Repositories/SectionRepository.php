<?php

namespace App\Repositories;

use App\Http\Requests\Sections\SectionRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Section;

class SectionRepository extends Repository
{
    protected Section $section;

    function __construct()
    {
        $this->section = new Section;
    }

    function set(SectionRequest $request)
    {
        try {
            // ユーザーの作成
            $user = $this->section::create([
                'title' => $request->input('title'),
                'topic' => $request->input('topic')
            ]);
            //return response()->json(['user' => $user], 201);
        } catch (QueryException $e) {
            // データベースエラーの場合、例外メッセージを返す
            return response()->json(['error' => 'Database error occurred'], 500);
        }
    }
}
