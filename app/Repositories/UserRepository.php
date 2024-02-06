<?php

namespace App\Repositories;

use App\Http\Requests\Users\UserRegisterRequest;
use App\Http\Requests\Users\AdminRegisterRequest;
use App\Models\Admin;
use App\Models\AdminInvitation;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserRepository extends Repository
{
    protected User $user;
    protected Admin $admin;
    protected Invitation $invitation;
    protected AdminInvitation $admin_invitation;

    public function __construct()
    {
        $this->user = new User;
        $this->admin = new Admin;
        $this->invitation = new Invitation;
        $this->admin_invitation = new AdminInvitation;
    }

    public function saveToken($email, $token): string
    {
        try {
            $this->invitation->fill([
                'email' => $email,
                'token' => $token
            ])->save();
            return "saved";
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function saveAdminToken($email, $token): string
    {
        try {
            $this->admin_invitation->fill([
                'email' => $email,
                'token' => $token
            ])->save();
            return "saved";
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function setUser(UserRegisterRequest $request): string
    {
        try {
            $this->user->fill([
                'name' => Crypt::encryptString($request->input('name')),
                'email' => $request->input('email'),
                'code' => "",
                'icon_image_path' => "",
                'password' => Hash::make($request->input('password'))
            ])->save();
            return "saved";
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function add(UserRegisterRequest $request): string
    {
        try {
            $upload_file = $request->file('icon');
            if (!empty($upload_file)) {
                $x = 100; // 300px
                $y = 100; // 300px

                $img = Image::make(file_get_contents($upload_file->getRealPath()))->crop($x, $y);
                /*$img->resize($x, $y, function($constraint) {
                    $constraint->aspectRatio(); // アスペクト比を保つ
                });*/
                $img->save($upload_file->getRealPath());

                // アップロード先S3フォルダ名
                $dir = 'icon';
                $filename = time() . ".jpg";
                // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。

                if (env('FILE_STORAGE_METHOD') === "s3") {
                    // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
                    $s3_upload = Storage::disk('s3')->putFile('/' . $dir, $img);
                }

                if (env('FILE_STORAGE_METHOD') === "gcs") {
                    Storage::disk('gcs')->put('/' . $dir . "/" . $filename, $img);
                }

                // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
                $icon_image_path = $dir . '/' . $filename;
            } else {
                $icon_image_path = '';
            }
            $this->user->fill([
                'name' => Crypt::encryptString($request->input('name')),
                'email' => $request->input('email'),
                'code' => $request->input('code'),
                'icon_image_path' => $icon_image_path,
                'password' => Hash::make($request->input('password'))
            ])->save();
            return "saved";
        } catch (\Exception $e) {
// 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function update(UserRegisterRequest $request, int $id): string
    {
        try {
            $upload_file = $request->file('icon');

            if (!empty($upload_file)) {
                $x = 100; // 300px
                $y = 100; // 300px

                $img = Image::make($upload_file->getRealPath())->resize($x, $y, function ($constraint) {
                    $constraint->aspectRatio(); // アスペクト比を保つ
                })->crop($x, $y)->save($upload_file->getRealPath());

                // アップロード先S3フォルダ名
                $dir = 'icon/user/' . $id . "/";
                $filename = time() . ".jpg";

                if (env('FILE_STORAGE_METHOD') === "s3") {
                    // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
                    $s3_upload = Storage::disk('s3')->putFile('/' . $dir, $img);
                }

                if (env('FILE_STORAGE_METHOD') === "gcs") {
                    Storage::disk('gcs')->put('/' . $dir . "/" . $filename, $img);
                }

                // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
                $icon_image_path = $dir . '/' . $filename;
            } else {
                $icon_image_path = '';
            }
            $array = [
                'name' => Crypt::encryptString($request->input('name')),
                'email' => $request->input('email'),
                'code' => $request->input('code'),
                'icon_image_path' => $icon_image_path,

            ];
            if ($request->has('password')) {
                $array['password'] = Hash::make($request->input('password'));
            }
            $this->user->find($id)->fill($array)->save();
            return "updated";
        } catch (\Exception $e) {
// 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }
    public function updatePassword(UserRegisterRequest $request, int $id): string
    {
        $user = $this->user->find($id);
        $user->fill([
            'password' => Hash::make($request->input('password'))
        ]);
        $user->save();
        return 'updated';
    }
    public function addAdmin(AdminRegisterRequest $request): string
    {
        try {
            $this->admin->fill([
                'name' => Crypt::encryptString($request->input('name')),
                'email' => $request->input('email'),
                'code' => $request->input('code'),
                'icon_image_path' => "",
                'password' => Hash::make($request->input('password'))
            ])->save();
            return "saved";
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function updateAdmin(AdminRegisterRequest $request, int $id): string
    {
        try {
            $admin = $this->admin->find($id);
            $admin->fill([
                'name' => Crypt::encryptString($request->input('name')),
                'code' => $request->input('code'),
                'icon_image_path' => "",
                'email' => $request->input('email')
            ]);

            if ($request->has('password') && !empty($request->input('password'))) {
                $admin->password = Hash::make($request->input('password'));
            }
            $admin->save();
            return 'updated';
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            // エラーログを出力するなど
            Log::error("An error occurred in update" . __METHOD__ . ": " . $e->getMessage());

            // エラーをユーザーに通知するためのステータス
            return "error";
        }
    }

    public function updatePasswordAdmin(AdminRegisterRequest $request, int $id): string
    {
        $admin = $this->admin->find($id);
        $admin->fill([
            'password' => Hash::make($request->input('password'))
        ]);
        $admin->save();
        return 'updated';
    }

}

