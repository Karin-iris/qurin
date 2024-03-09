<?php

namespace App\UseCases;

use App\QueryServices\ResultQueryService;
use App\Repositories\ResultRepository;

use Illuminate\Support\Facades\DB;

class ResultUseCase extends UseCase
{
    protected ResultQueryService $resultQS;
    protected ResultRepository $resultR;

    function __construct(){
        $this->resultQS = new ResultQueryService;
        $this->resultR = new ResultRepository;
    }

    function getData(){
        return $this->resultQS->get();

    }
}
