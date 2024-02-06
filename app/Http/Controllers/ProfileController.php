<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Users\AdminRegisterRequest;
use App\UseCases\UserConfigUseCase;
use App\UseCases\UserUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;


class ProfileController extends Controller
{
    public UserUseCase $userUC;
    public UserConfigUseCase $userConfigUC;

    public function __construct()
    {
        $this->userUC = new UserUseCase();
        $this->userConfigUC = new UserConfigUseCase();
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            //'user' => $request->user(),
            'user' => $this->userUC->getUser(Auth::id()),
        ]);
    }

    public function admin_edit(Request $request): View
    {
        $admin = $this->userUC->getAdmin(Auth::guard('admin')->id());
        list($qr_image, $secret) = $this->userUC->displayMFA(Auth::guard('admin')->id());
        return view('profile.admin_edit',
            compact('qr_image', 'secret', 'admin')
        );

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /*$request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();*/
        $status = $this->userUC->update($request, Auth::guard('admin')->id());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Update the user's profile information.
     */
    public function admin_update(AdminRegisterRequest $request): RedirectResponse
    {
        /*$request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();*/
        $status = $this->userUC->updateAdmin($request, Auth::guard('admin')->id());

        return Redirect::route('profile.admin_edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
