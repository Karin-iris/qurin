<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\Examination;
use Intervention\Image\Exception\NotFoundException;

class ExaminationQueryService extends QueryService
{
    protected Examination $examination;
    function __construct()
    {
        $this->examination = new Examination;
    }
    function get($id){
        try{
            return $this->examination::findOrFail($id);
        }catch(NotFoundException $e){
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    function getExaminations(){
        return $this->examination->get();
    }
}
