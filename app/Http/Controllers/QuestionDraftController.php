<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\UseCases\QuestionUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class QuestionDraftController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('questiondraft.edit', [
            'question' => $request->all(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        print_r($request->all());

        //$request->user()->save();

        return Redirect::route('questiondraft.edit',1)->with('status', 'question-updated');
    }
}
