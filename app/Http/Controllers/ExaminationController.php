<?php

namespace App\Http\Controllers;

use App\Http\Requests\Examinations\ExaminationRequest;
use App\UseCases\ExaminationUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        $this->examinationUC->set($request);//
        return Redirect::route('examination.create')->with('examination', 'saved');//
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
        $examination = $this->examinationUC->get($id);
        return view('examination.edit',compact('examination'));
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
