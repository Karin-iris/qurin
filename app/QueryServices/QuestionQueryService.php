<?php

namespace App\QueryServices;

use App\Http\Requests\Questions\SearchRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionQueryService extends QueryService
{
    protected Question $question;

    public function __construct()
    {
        $this->question = new Question;
    }

    public function getPaginate(Request $request)
    {
        $query = $this->question->select(
            [
                'p.name as p_c_name',
                's.name as s_c_name',
                'c.name as c_name',
                'p.code as p_c_code',
                's.code as s_c_code',
                'c.code as c_code',
                'q.topic as topic',
                'q.id as id',
                'q.section_id as section_id',
                'q.text as text',
                'q.quiz_id as quiz_id',
                'q.user_name as user_name',
                'q.is_request as is_request',
                'q.is_approve as is_approve',
                'q.is_remand as is_remand',
                'q.is_adopt as is_adopt',
                'q.created_at as created_at',
                'q.updated_at as updated_at',
            ]
        )->from('questions as q')
            ->leftJoin('categories as c', 'c.id', '=', 'q.category_id')
            ->leftJoin('secondary_categories as s', 'c.secondary_id', '=', 's.id')
            ->leftJoin('primary_categories as p', 's.primary_id', '=', 'p.id')
            ->leftJoin('users as u', 'u.id', '=', 'q.user_id');
        if ($request->query('search')) {
            $searchTerm = $request->query('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('text', 'like', "%" . $searchTerm . "%")
                    ->orWhere('topic', 'like', "%" . $searchTerm . "%");
            });
        }
        if ($request->query('c_id')) {
            $query->where('c.id', $request->query('c_id'));
        }
        if ($request->query('p_id')) {
            $query->where('p.id', $request->query('p_id'));
        }
        if ($request->query('s_id')) {
            $query->where('s.id', $request->query('s_id'));
        }
        if ($request->query('se_id')) {
            $query->where('q.section_id', $request->query('se_id'));
        }
        if ($request->has('has_quizid') && $request->input('has_quizid') === '1') {
            $query->whereNotNull('q.quiz_id');
        }
        if ($request->input('qurinid')) {
            $query->where('q.id','LIKE','%'.$request->query('qurinid')."%");
        }
        if ($request->input('quizid')) {
            $query->where('q.quiz_id','LIKE','%'.$request->query('quizid')."%");
        }
        if ($request->query('l')) {
            $l = $request->query('l');
            $query->where(function ($q) use ($l) {
                foreach ($l as $competency) {
                    $q->orWhere('compitency', $competency);
                }
            });
        }
        if ($request->query('sort')) {
            $query->orderBy($request->query('sort'), $request->query('order'));
        }
        if ($request->query('perPage')) {
            $perpage = $request->query('perpage');
        } else {
            $perpage = 20;
        };
        return $query->paginate($perpage);
    }

    public function getQuestions(SearchRequest $request)
    {
        $query = $this->question->select(
            [
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
                'q.is_adopt as is_adopt',
                'q.created_at as created_at',
                'q.updated_at as updated_at',
            ]
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
        if ($request->has('is_quizid') && $request->input('is_quizid')) {
            $query->whereNotNull('q.quiz_id');
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
