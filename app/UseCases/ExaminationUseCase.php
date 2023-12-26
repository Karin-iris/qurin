<?php

namespace App\UseCases;

use App\Models\Examination;
use App\QueryServices\ExaminationQueryService;
use App\Repositories\ExaminationRepository;
use Illuminate\Support\Facades\DB;

class ExaminationUseCase extends UseCase
{
    public Examination $examination;
    protected ExaminationRepository $examinationR;
    protected ExaminationQueryService $examinationQS;

    function __construct()
    {
        $this->examination = new Examination;
        $this->examinationR = new ExaminationRepository();
        $this->examinationQS = new ExaminationQueryService();
    }
    function getExaminations(){
        return $this->examinationQS->getExaminations();
    }

    // ここにリポジトリのコードを追加
}
