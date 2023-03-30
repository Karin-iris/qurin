<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select([
            'p.name as p_name',
            's.name as s_name',
            'c.name as name',
            'c.id as id',
            'p.id as p_id',
            's.id as s_id',
        ])->from('categories as c')->rightJoin('secondary_categories as s', function ($join) {
            $join->on('c.secondary_id', '=', 's.id');
            $join->rightJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            });
        })->orderBy('p.order')->orderBy('s.order')->orderBy('c.order')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
