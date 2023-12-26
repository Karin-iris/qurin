<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\Section;

class SectionQueryService extends QueryService
{
    protected Section $section;

    function __construct(){
        $this->section = new Section;
    }
    function getSections(){
        return $this->section->get();
    }
}
