<?php

namespace App\UseCases;

use App\QueryServices\SectionQueryService;
use App\Repositories\SectionRepository;

use Illuminate\Support\Facades\DB;

class SectionUseCase extends UseCase
{
    protected SectionQueryService $sectionQS;
    protected SectionRepository $sectionR;

    function __construct(){
        $this->sectionQS = new SectionQueryService;
        $this->sectionR = new SectionRepository;
    }

    function getSections(){
        return $this->sectionQS->getSections();
    }
}
