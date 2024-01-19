<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionQueryService extends QueryService
{
    protected Section $section;

    function __construct(){
        $this->section = new Section;
    }
    function get(int $id){
        return $this->section->findOrFail($id);
    }
    function getPaginate(Request $request){
        $query = $this->section->query();
        if($request->query('search')){
            $searchTerm = $request->query('search');
            $query->where(function($query) use ($searchTerm) {
                $query->where('title','like',"%".$searchTerm."%")
                    ->orWhere('topic','like',"%".$searchTerm."%");
            });
        }
        if($request->query('sort')){
            $query->orderBy($request->query('sort'), $request->query('order'));
        }
        if($request->query('perPage')) {
            $perpage = $request->query('perpage');
        }else{
            $perpage = 20;
        };
        return $query->paginate($perpage);
    }

    function getList(){
        return $this->section->pluck('title', 'id');
    }

    function getData(){
        return $this->section->get();
    }
}
