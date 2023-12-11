<?php

namespace App\UseCases;

use App\Http\Requests\UserRegistRequest;
use App\Models\QuestionCase;
use App\Models\QuestionImage;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\UserInviteMail;
use App\Mail\AdminInviteMail;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;

class UserUseCase extends UseCase
{

    public User $user;
    public Admin $admin;
    public UserRepository $UserRepository;

    public function __construct()
    {
        $this->user = new User();
        $this->admin = new Admin();
        $this->UserRepository = new UserRepository();
    }

    public function sendInviteMail(UserRegistRequest $request): void
    {
        $name = 'ユーザーの招待が届いています。';
        $email = $request->input('email');
        $token = md5($email);
        Mail::send(new UserInviteMail($name, $email, $token));
    }

    public function sendAdminInviteMail(UserRegistRequest $request): void
    {
        $name = '管理者の招待が届いています。';
        $email = $request->input('email');
        $token = $this->generateToken();
        $this->UserRepository->saveToken($email, $token);

        Mail::send(new AdminInviteMail($name, $email, $token));
    }
    public function generateToken(): string
    {
        return md5("aaaabbbbaaaa");
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
                'id', 'name', 'password', 'email'
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
        return $this->admin->select('id', 'name', 'password', 'email')->from('admins')->get();
    }

    function saveUser(UserRegistRequest $request)
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

            // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
            $s3_upload = Storage::disk('s3')->putFile('/' . $dir, $img);

            // ※オプション（ファイルダウンロード、削除時に使用するS3でのファイル保存名、アップロード先のパスを取得します。）
            // アップロードファイルurlを取得
            $s3_url = Storage::disk('s3')->url($s3_upload);

            // s3_urlからS3でのファイル保存名取得
            $s3_upload_file_name = explode("/", $s3_url)[4];

            // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
            $s3_path = $dir . '/' . $s3_upload_file_name;
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

    function updateUser(UserRegistRequest $request, int $id)
    {
        $upload_file = $request->file('icon');
        if (!empty($upload_file)) {
            $x = 100; // 300px
            $y = 100; // 300px

            $img = \Image::make($upload_file->getRealPath())->resize($x, $y, function ($constraint) {
                $constraint->aspectRatio(); // アスペクト比を保つ
            })->crop($x, $y)->save($upload_file->getRealPath());

            // アップロード先S3フォルダ名
            $dir = 'icon';

            // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
            $s3_upload = Storage::disk('s3')->putFile('/' . $dir, $upload_file);

            $s3_url = Storage::disk('s3')->url($s3_upload);
            // s3_urlからS3でのファイル保存名取得
            $s3_upload_file_name = explode("/", $s3_url)[4];

            // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
            $s3_path = $dir . '/' . $s3_upload_file_name;
        } else {
            $s3_path = '';
        }

        $this->user->find($id)->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'icon_image_path' => $s3_path,
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function saveAdmin(UserRegistRequest $request)
    {
        $this->user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function updateAdmin(UserRegistRequest $request, int $id)
    {
        $this->user->find($id)->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->save();
    }
}
