<?php

namespace App\Http\Controllers;

use App\UseCases\UserConfigUseCase;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;
use App\UseCases\UserUseCase;
use BaconQrCode\Writer;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

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

    public function verify_admin_login(Request $request)
    {
        $google2fa = new Google2FA();

        $admin = Auth::guard('admin')->user();

        // MFAコードが正しいか検証
        try {
            $valid = $google2fa->verifyKey($admin->mfa_secret, $request->input('mfa_code'));

            if ($valid) {
                // MFA検証に成功した場合
                session(['mfa_verified' => true]);
                return redirect()->intended('/admin_dashboard');
            } else {
                // MFA検証に失敗した場合
                return back()->withErrors(['mfa_code' => 'The MFA code is invalid.']);
            }
        } catch (IncompatibleWithGoogleAuthenticatorException|InvalidCharactersException|SecretKeyTooShortException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    public function admin_regist(int $id)
    {
        //$admin = Auth::guard('admin')->user();
        $admin = $this->userUC->getAdmin($id);
        // MFAシークレットキーを生成（まだデータベースに保存しない）
        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();

        // Google Authenticator用のQRコードURLを生成
        $google2fa_url = $google2fa->getQRCodeUrl(
            config('app.name'),
            $admin->email,
            $secret
        );


        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        //$writer->writeFile('Hello World!', 'qrcode.png');

        $qr_image = base64_encode($writer->writeString($google2fa_url));//, ErrorCorrectionLevel::MEDIUM));

        return view('mfa.admin_regist', compact('qr_image', 'secret','id'));
    }
    public function update_admin_regist(Request $request){
                // MFAコードが正しいか検証
        $google2fa = new Google2FA();
        try{
            $valid = $google2fa->verifyKey($request->input('mfa_secret'), $request->input('mfa_code'));

            if ($valid) {
                // MFA検証に成功した場合
                session(['mfa_verified' => true]);

                return redirect()->intended('/admin_dashboard');
            } else {
                // MFA検証に失敗した場合
                return back()->withErrors(['mfa_code' => 'The MFA code is invalid.']);
            }

        } catch (IncompatibleWithGoogleAuthenticatorException|InvalidCharactersException|SecretKeyTooShortException $e) {

        }

    }

}

