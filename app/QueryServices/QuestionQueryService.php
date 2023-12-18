<?php

namespace App\QueryServices;

use App\Http\Requests\Questions\SearchRequest;
use App\Models\Question;
use App\Models\QuestionCase;
use Illuminate\Support\Facades\DB;

class QuestionQueryService extends QueryService
{
    protected Question $question;
    protected QuestionCase $question_case;
    public function __construct()
    {
        $this->question = new Question;
        $this->question_case = new QuestionCase;
        $this->question_summary_column = [
            'p.name as p_c_name',
            's.name as s_c_name',
            'c.name as c_name',
            'p.code as p_c_code',
            's.code as s_c_code',
            'c.code as c_code',
            'q.user_name as user_name',
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

    public function getQuestions(SearchRequest $request){
        $query = $this->question->select(
            $this->question_admin_summary_column
        )->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->leftJoin('users as u', 'u.id', '=', 'q.user_id')
            ->where(function ($query) {
                $query->Where('is_request', '1')->orWhere('is_approve', '1')->orWhere('is_remand', '1');
            });
        // 検索パラメータがある場合、それを使ってフィルタリング
        if ($request->has('string')) {
            $query->where(function ($query) use ($request) {
                $query->where('q.text', 'like', '%' . $request->input('string') . '%')
                    ->orWhere('q.explanation', 'like', '%' . $request->input('string') . '%')
                    ->orWhere('q.topic', 'like', '%' . $request->input('string') . '%');

            });
        }
        if ($request->has('competency')) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('q.compitency', $request->input('competency'));
            });
        }
        if ($request->has('primary_id')) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('s.primary_id', $request->input('primary_id'));
            });
        }
        if ($request->has('secondary_id')) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('c.secondary_id', $request->input('secondary_id'));
            });
        }
        if ($request->has('category_id')) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('q.category_id', $request->input('category_id'));
            });
        }
        return $query->get();
    }
}
