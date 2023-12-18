<?php

namespace App\Repositories;

use App\Http\Requests\Questions\SearchRequest;
use Illuminate\Support\Facades\DB;

class QuestionRepository extends Repository
{
    protected Question $question;
    protected QuestionCase $question_case;// ここにリポジトリのコードを追加


}
