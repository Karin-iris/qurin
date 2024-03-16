<?php

namespace App\UseCases;

use App\Http\Requests\Examinations\ExaminationRequest;
use App\QueryServices\ExaminationQueryService;
use App\Repositories\ExaminationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\QueryServices\CategoryQueryService;

class ExaminationUseCase extends UseCase
{
    protected ExaminationRepository $examinationR;
    protected ExaminationQueryService $examinationQS;

    public function __construct()
    {
        $this->examinationR = new ExaminationRepository();
        $this->examinationQS = new ExaminationQueryService();
    }
    public function getPaginate(Request $request){
        return $this->examinationQS->getPaginate( $request);
    }

    public function get($id){
        return $this->examinationQS->get($id);
    }

    public function getList(){
        return $this->examinationQS->getList();
    }

    public function getData(): Collection
    {
        return $this->examinationQS->getData();
    }
    public function getGpt(int $examinationId,int $categoryId){
        $CategoryQS = new CategoryQueryService();
        $category_array = $CategoryQS->getDetail($categoryId);
        $str = $this->examinationQS->getGptString($examinationId);

        $str = str_replace('[p_name]', $category_array['p_name'], $str);
        $str = str_replace('[s_name]', $category_array['s_name'], $str);
        return str_replace('[c_name]', $category_array['name'], $str);
    }
    public function add(ExaminationRequest $request){
        return $this->examinationR->add($request);
    }

    public function update(ExaminationRequest $request, int $id){
        return $this->examinationR->update($request,$id);
    }
    // ここにリポジトリのコードを追加
}
