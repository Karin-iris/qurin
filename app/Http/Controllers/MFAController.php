<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Writer;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class MFAController extends Controller
{
    public function admin_login()
    {
        return view('mfa.admin_login');
    }

    public function verify_admin_login(Request $request)
    {
        $google2fa = new Google2FA();

        $admin = Auth::guard('admin')->user();

        // MFAコードが正しいか検証
        $valid = $google2fa->verifyKey($admin->mfa_secret, $request->input('mfa_code'));

        if ($valid) {
            // MFA検証に成功した場合
            session(['mfa_verified' => true]);
            return redirect()->intended('/admin_dashboard');
        } else {
            // MFA検証に失敗した場合
            return back()->withErrors(['mfa_code' => 'The MFA code is invalid.']);
        }
    }
    public function admin_regist()
    {
        $admin = Auth::guard('admin')->user();

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

        return view('mfa.admin_regist', compact('qr_image', 'secret'));
    }
    public function update_admin_regist(){

    }

}

