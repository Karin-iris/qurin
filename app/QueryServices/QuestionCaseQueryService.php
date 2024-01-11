<?php

namespace App\QueryServices;

use App\Http\Requests\Questions\SearchRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\QuestionCase;

class QuestionCaseQueryService extends QueryService
{
    public QuestionCase $QuestionCase;
    public function __construct()
    {
        $this->QuestionCase = new QuestionCase;
    }

    function getData(){
        try{
            return $this->QuestionCase::get();
        }catch(NotFoundException $e){
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function getQuestionCasesWithQuestions(): Collection
    {
        $this->QuestionCase->questions();
        return $this->QuestionCase::with('questions')->withCount('questions')->get();
    }
}
