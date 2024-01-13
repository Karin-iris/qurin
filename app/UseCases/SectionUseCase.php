<?php

namespace App\UseCases;

use App\QueryServices\SectionQueryService;
use App\Repositories\SectionRepository;
use App\Http\Requests\Sections\SectionRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionUseCase extends UseCase
{
    protected SectionQueryService $sectionQS;
    protected SectionRepository $sectionR;

    function __construct(){
        $this->sectionQS = new SectionQueryService;
        $this->sectionR = new SectionRepository;
    }

    function get($id){
        return $this->sectionQS->get($id);
    }

    function getPaginate(Request $request){
        return $this->sectionQS->getPaginate($request);
    }

    function set(SectionRequest $request){
        return $this->sectionR->set($request);
    }
}
