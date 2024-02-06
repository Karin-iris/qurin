<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AdminRegisterRequest;
use App\UseCases\UserConfigUseCase;
use App\UseCases\UserUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UserRegisterRequest;

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
    public function update(UserRegisterRequest $request): RedirectResponse
    {
        /*$validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);*/
        echo $this->userUC->updatePassword($request, Auth::id());
        return back()->with('status', 'password-updated');
    }

    public function admin_update(AdminRegisterRequest $request): RedirectResponse
    {
        /*$validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);*/
        echo $this->userUC->updatePasswordAdmin($request, Auth::guard('admin')->id());
        return back()->with('status', 'password-updated');
    }
}
