<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Result;

class ResultRepository extends Repository
{
    protected Result $result;

    function __construct(){
        $this->result = new Result;
    }
}