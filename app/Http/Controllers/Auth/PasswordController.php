<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UseCases\UserConfigUseCase;
use App\UseCases\UserUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public UserUseCase $userUC;
    public UserConfigUseCase $userConfigUC;

    public function __construct()
    {
        $this->userUC = new UserUseCase();
        $this->userConfigUC = new UserConfigUseCase();
    }
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        /*$request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);*/
        echo $this->userUC->updatePassword($request ,Auth::id);
        return back()->with('status', 'password-updated');
    }
}
