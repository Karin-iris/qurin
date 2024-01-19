<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use App\UseCases\SectionUseCase;
use Illuminate\Http\JsonResponse;

class ApiSectionController extends Controller
{
    protected SectionUseCase $sectionUC;
    public function __construct(){
        $this->sectionUC = new SectionUseCase();
    }
    public function paginate(Request $request) : JsonResponse
    {
        return response()->json(
            $this->sectionUC->getPaginate($request)
        );
    }
    public function get_data(): JsonResponse
    {
        return response()->json(
            $this->sectionUC->getData()
        );
    }
}
