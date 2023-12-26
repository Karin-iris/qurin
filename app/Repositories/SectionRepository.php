<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Section;

class SectionRepository extends Repository
{
    protected Section $section;

    function __construct(){
        $this->section = new Section;
    }
}