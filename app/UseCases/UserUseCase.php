<?php

namespace App\UseCases;

use App\Http\Requests\Users\AdminRegisterRequest;
use App\Http\Requests\Users\UserRegisterRequest;
use App\Mail\AdminInviteMail;
use App\Mail\UserInviteMail;
use App\Models\Admin;
use App\Models\User;
use App\QueryServices\UserQueryService;
use App\Repositories\UserRepository;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;

class UserUseCase extends UseCase
{

    public User $user;
    public Admin $admin;
    public UserRepository $userR;
    protected UserQueryService $userQS;
    public function __construct()
    {
        $this->user = new User();
        $this->admin = new Admin();
        $this->userR = new UserRepository();
        $this->userQS = new UserQueryService();
    }
    function getPaginate(Request $request){
        return $this->userQS->getPaginate($request);
    }
    public function sendInviteMail(UserRegisterRequest $request): void
    {
        $name = 'ユーザーの招待が届いています。';
        $email = $request->input('email');
        $token = $this->generateToken($email);
        $this->userR->saveToken($email, $token);
        Mail::send(new UserInviteMail($name, $email, $token));
    }
    public function generateToken($email): string
    {
        return md5($email.Carbon::now());
    }
    public function getEmailFromToken($token){
        return $this->userQS->getEmailFromToken($token);
    }
    public function setUserFromToken(UserRegisterRequest $request,$token){
        return $this->userR->setUserFromToken($request);
    }
    public function sendAdminInviteMail(AdminRegisterRequest $request): void
    {
        $name = '管理者の招待が届いています。';
        $email = $request->input('email');
        $token = $this->generateAdminToken($email);
        $this->userR->saveAdminToken($email, $token);

        Mail::send(new AdminInviteMail($name, $email, $token));
    }
    public function generateAdminToken($email): string
    {
        return md5($email.Carbon::now());
    }
    public function getEmailFromAdminToken($token){
        return $this->userQS->getEmailFromAdminToken($token);
    }
    public function setAdminFromToken(AdminRegisterRequest $request,$token){
        return $this->userR->setAdmin($request);
    }
    public function getUser(int $id)
    {
        $user = $this->user->select(
            'id', 'name', 'password', 'email', 'icon_image_path'
        )->from('users')->where('id', $id)->firstOrFail();
        if (!empty($user)) {
            $user->name = Crypt::decryptString($user->name);
        }
        return $user;
    }

    function getUsers()
    {
        return $this->user->select('id', 'name', 'password', 'email', 'icon_image_path')->from('users')->get();
    }

    function getAdmin(int $id)
    {
        try {
            $user = $this->admin->select(
                'id', 'name', 'password', 'email','code'
            )->from('admins')->where('id', $id)->firstOrFail();
            if (!empty($user)) {
                $user->name = Crypt::decryptString($user->name);
            }
            return $user;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // レコードが見つからない場合の処理
            // 例: ログを記録し、カスタムエラーメッセージを返す
            Log::error("Admin not found with ID: $id");
            return ['error' => "Admin not found."];
        } catch (\Exception $e) {
            // その他の例外（例えば復号化の失敗など）の処理
            // 例: エラーメッセージをログに記録し、汎用的なエラーメッセージを返す
            Log::error("An error occurred: " . $e->getMessage());
            return ['error' => "An error occurred."];
        }
    }

    function getAdmins()
    {
        return $this->admin->select('id', 'name', 'password', 'email', 'mfa_enabled')->from('admins')->get();
    }

    function saveUser(UserRegisterRequest $request): void
    {
        $upload_file = $request->file('icon');
        if (!empty($upload_file)) {
            $x = 100; // 300px
            $y = 100; // 300px

            $img = \Image::make(file_get_contents($upload_file->getRealPath()))->crop($x, $y);
            /*$img->resize($x, $y, function($constraint) {
                $constraint->aspectRatio(); // アスペクト比を保つ
            });*/
            $img->save($upload_file->getRealPath());

            // アップロード先S3フォルダ名
            $dir = 'icon';
            $filename = time().".jpg";
            // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。

            if (env('FILE_STORAGE_METHOD')=="s3") {
                // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
                $s3_upload = Storage::disk('s3')->putFile('/' . $dir, $img);
            }

            if (env('FILE_STORAGE_METHOD')=="gcs") {
                Storage::disk('gcs')->put('/' . $dir ."/". $filename, $img);
            }

            // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
            $s3_path = $dir . '/' . $filename;
            exit();
        } else {
            $s3_path = '';
        }
        $this->user->fill([
            'name' => Crypt::encryptString($request->input('name')),
            'email' => $request->input('email'),
            'icon_image_path' => $s3_path,
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function updateUser(UserRegisterRequest $request, int $id)
    {
        $upload_file = $request->file('icon');

        if (!empty($upload_file)) {
            $x = 100; // 300px
            $y = 100; // 300px

            $img = \Image::make($upload_file->getRealPath())->resize($x, $y, function ($constraint) {
                $constraint->aspectRatio(); // アスペクト比を保つ
            })->crop($x, $y)->save($upload_file->getRealPath());

            // アップロード先S3フォルダ名
            $dir = 'icon/user/'.$id."/";
            $filename = time().".jpg";

            if (env('FILE_STORAGE_METHOD')=="s3") {
                // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
                $s3_upload = Storage::disk('s3')->putFile('/' . $dir, $img);
            }

            if (env('FILE_STORAGE_METHOD')=="gcs") {
                Storage::disk('gcs')->put('/' . $dir ."/". $filename, $img);
            }

            // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
            $s3_path = $dir . '/' . $filename;
        } else {
            $s3_path = '';
        }

        $this->user->find($id)->fill([
            'name' => Crypt::encryptString($request->input('name')),
            'email' => $request->input('email'),
            'icon_image_path' => $s3_path,
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function saveAdmin(AdminRegisterRequest $request)
    {
        $this->admin->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function updateAdmin(AdminRegisterRequest $request, int $id)
    {
        $admin = $this->admin->find($id);
        $admin->fill([
            'name' => Crypt::encryptString($request->input('name')),
            'code' => $request->input('code'),
            'email' => $request->input('email')
        ]);

        if ($request->has('password') && !empty($request->input('password'))) {
            $admin->password = Hash::make($request->input('password'));
        }
        $admin->save();
    }

    function addMFA(String $mfa_secret,int $id){
        $this->admin->find($id)->fill([
            'mfa_secret' => $mfa_secret,
            'mfa_enabled' => 1
        ])->save();
    }
    function checkMFA(string $mfa_secret,string $mfa_code){
        // MFAコードが正しいか検証
        try {
            $google2fa = new Google2FA();
            $valid = $google2fa->verifyKey($mfa_secret,$mfa_code);

            if ($valid) {
                // MFA検証に成功した場合
                session(['mfa_verified' => true]);
                return true;
            } else {
                // MFA検証に失敗した場合
                return back()->withErrors(['mfa_code' => 'The MFA code is invalid.']);
            }
        } catch (IncompatibleWithGoogleAuthenticatorException|InvalidCharactersException|SecretKeyTooShortException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws SecretKeyTooShortException
     * @throws InvalidCharactersException
     */
    function displayMFA(int $id): array
    {
        $admin = $this->getAdmin($id);
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

        $qr_image = base64_encode($writer->writeString($google2fa_url));//, ErrorCorrectionLevel::MEDIUM));
        return [$qr_image,$secret];
    }
    function registerMFA(string $mfa_secret,string $mfa_code,int $id){
        $google2fa = new Google2FA();
        try{
            $valid = $google2fa->verifyKey($mfa_secret, $mfa_code);

            if ($valid) {
                $this->addMFA($mfa_secret, $id);

            } else {
                // MFA検証に失敗した場合
                return back()->withErrors(['mfa_code' => 'The MFA code is invalid.']);
            }

        } catch (IncompatibleWithGoogleAuthenticatorException|InvalidCharactersException|SecretKeyTooShortException $e) {
            return false;
        }
    }
}
