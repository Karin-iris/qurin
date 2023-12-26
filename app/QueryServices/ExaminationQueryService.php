<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\Examination;

class ExaminationQueryService extends QueryService
{
    protected Examination $examination;
    function __construct(){
        $this->examination = new Examination;
    }
    function getExaminations(){
        return $this->examination->get();
    }
}
