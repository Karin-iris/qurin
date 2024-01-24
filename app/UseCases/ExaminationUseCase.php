<?php

namespace App\UseCases;

use App\Http\Requests\Examinations\ExaminationRequest;
use App\Models\Examination;
use App\QueryServices\ExaminationQueryService;
use App\Repositories\ExaminationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
    function getPaginate(Request $request){
        return $this->examinationQS->getPaginate( $request);
    }

    function get($id){
        return $this->examinationQS->get($id);
    }

    function add(ExaminationRequest $request){
        return $this->examinationR->add($request);
    }

    function update(ExaminationRequest $request, int $id){
        return $this->examinationR->update($request,$id);
    }
    // ここにリポジトリのコードを追加
}
