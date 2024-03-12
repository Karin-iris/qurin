<?php

namespace App\Http\Controllers;

use App\Http\Requests\Examinations\ExaminationRequest;
use App\UseCases\ExaminationUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
class ExaminationController extends Controller
{
    protected ExaminationUseCase $examinationUC;

    public function __construct()
    {
        $this->examinationUC = new ExaminationUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('examination.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('examination.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExaminationRequest $request)
    {
        $status = $this->examinationUC->add($request);//
        return Redirect::route('examination.index')->with('status', $status);////
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $examination = $this->examinationUC->get($id);
        return view('examination.edit',compact('examination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExaminationRequest $request, string $id):RedirectResponse
    {
        $status = $this->examinationUC->update($request,$id);
        return Redirect::route('examination.index')->with('status', $status);////
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
