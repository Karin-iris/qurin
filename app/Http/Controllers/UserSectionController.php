<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sections\SectionRequest;
use App\UseCases\SectionUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserSectionController extends Controller
{
    public function __construct()
    {
        $this->sectionUC = new SectionUseCase();
    }
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('usersection.index');//
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('usersection.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request):RedirectResponse
    {
        $this->sectionUC->set($request);//
        return Redirect::route('usersection.create')->with('section', 'saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        $section = $this->sectionUC->get($id);
        return view('usersection.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id):RedirectResponse
    {
        $this->sectionUC->mod($request,$id);//
        return Redirect::route('section.edit',['id'=>$id])->with('section', 'saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
