<?php

namespace App\UseCases;

use App\QueryServices\SectionQueryService;
use App\Repositories\SectionRepository;
use App\Http\Requests\Sections\SectionRequest;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SectionUseCase extends UseCase
{
    protected SectionQueryService $sectionQS;
    protected SectionRepository $sectionR;

    public function __construct()
    {
        $this->sectionQS = new SectionQueryService;
        $this->sectionR = new SectionRepository;
    }

    public function get($id)
    {
        return $this->sectionQS->get($id);
    }

    public function getPaginate(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->sectionQS->getPaginate($request);
    }

    public function getList(): \Illuminate\Support\Collection
    {
        return $this->sectionQS->getList();
    }

    public function getData(): Collection
    {
        return $this->sectionQS->getData();
    }

    public function add(SectionRequest $request): string
    {
        return $this->sectionR->add($request);
    }

    public function update(SectionRequest $request, int $id): string
    {
        return $this->sectionR->update($request, $id);
    }

}
