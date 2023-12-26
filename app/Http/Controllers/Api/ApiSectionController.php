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
    public function get_sections() : JsonResponse
    {
        return response()->json(
            $this->sectionUC->getSections()
        );
    }
}
