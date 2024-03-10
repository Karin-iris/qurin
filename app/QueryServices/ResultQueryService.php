<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\Result;

class ResultQueryService extends QueryService
{
    protected Result $result;

    function __construct(){
        $this->result = new Result;
    }

    function get(){
        $results = $this->result->select([
                'r.id as id',
                'r.title as title'
        ])
        ->selectRaw('COUNT(a.id) as count_answers')
        ->from('results as r')
        ->leftJoin('answers as a', 'r.id', '=', 'a.result_id')
        ->groupBy('r.id')
        ->get();
        foreach($results as $key => $result){
            $results[$key]['result_failed_count'] = $this->result
                ->from('answer_questions as aq')
                ->where('result_id',$result->id)
                ->whereNull('question_id')
                ->count();

        }
        return $results;
    }
}
