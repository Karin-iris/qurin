<?php

namespace App\Http\Controllers;

use App\UseCases\UserConfigUseCase;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use Illuminate\Support\Facades\Auth;
use App\UseCases\UserUseCase;

use SebastianBergmann\Timer\Exception;

class MFAController extends Controller
{
    protected UserUseCase $userUC;
    protected UserConfigUseCase $userConfigUC;

    public function __construct()
    {
        $this->userUC = new UserUseCase();
        $this->userConfigUC = new UserConfigUseCase();
    }

    public function admin_login()
    {
        return view('mfa.admin_login');
    }

    public function verify_admin_login(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        try {
            $admin = Auth::guard('admin')->user();
            $this->userUC->checkMFA($admin->mfa_secret, $request->input('mfa_code'));
            return redirect()->intended('/admin_dashboard');
        } catch (Exception $e) {
            return redirect()->intended('/error');
        }
    }

    public function admin_register(int $id)
    {
        try {
            list($qr_image, $secret) = $this->userUC->displayMFA($id);
            return view('mfa.admin_register', compact('qr_image', 'secret', 'id'));
        } catch (IncompatibleWithGoogleAuthenticatorException|InvalidCharactersException|SecretKeyTooShortException $e) {
        }

    }

    public function update_admin_register(Request $request, int $id)
    {
        try {
            $this->userUC->registerMFA($request->input('mfa_secret'), $request->input('mfa_code'), $id);
            return redirect()->intended('/admin_dashboard');
        } catch (Exception $e) {
            return redirect()->intended('/error');
        }
    }

}

