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
        $this->result->get();
    }
}
