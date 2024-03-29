<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sections\SectionRequest;
use App\UseCases\SectionUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class SectionController extends Controller
{
    public function __construct()
    {
        $this->sectionUC = new SectionUseCase();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('section.index');//
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        $status = $this->sectionUC->add($request);//
        return Redirect::route('section.index')->with('status', $status);////
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
        $section = $this->sectionUC->get($id);
        return view('section.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        $status = $this->sectionUC->update($request,$id);
        return Redirect::route('section.index')->with('status', $status);//////
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
