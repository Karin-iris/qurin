<?php

namespace App\UseCases;

use App\Http\Requests\Examinations\ExaminationRequest;
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

    function get($id){
        return $this->examinationQS->get($id);
    }

    function set(ExaminationRequest $request){
        return $this->examinationR->set($request);
    }

    function mod(ExaminationRequest $request, int $id){
        return $this->examinationR->mod($request,$id);
    }
    // ここにリポジトリのコードを追加
}
