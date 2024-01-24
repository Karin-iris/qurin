<?php

namespace App\QueryServices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Examination;
use Intervention\Image\Exception\NotFoundException;

class ExaminationQueryService extends QueryService
{
    protected Examination $examination;
    public function __construct()
    {
        $this->examination = new Examination;
    }
    public function getPaginate(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = $this->examination->query();
        if ($request->query('search')) {
            $searchTerm = $request->query('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%" . $searchTerm . "%")
                    ->orWhere('topic', 'like', "%" . $searchTerm . "%");
            });
        }
        if ($request->query('sort')) {
            $query->orderBy($request->query('sort'), $request->query('order'));
        }
        if ($request->query('perPage')) {
            $perpage = $request->query('perpage');
        } else {
            $perpage = 20;
        };
        return $query->paginate($perpage);
    }
    public function get($id){
        try {
            return $this->examination::findOrFail($id);
        }catch(NotFoundException $e){
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    public function getExaminations(){
        return $this->examination->get();
    }


}
