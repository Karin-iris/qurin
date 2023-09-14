<?php

namespace App\UseCases;

use App\Http\Requests\UserRegistRequest;
use App\Models\QuestionCase;
use App\Models\QuestionImage;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\UserInviteMail;
use App\Mail\AdminInviteMail;

class UserUseCase extends UseCase
{

    public User $user;
    public Admin $admin;

    function __construct()
    {
        $this->user = new User();
        $this->admin = new Admin();
    }

    function sendInviteMail(UserRegistRequest $request)
    {
        $name = 'ユーザーの招待が届いています。';
        $email = $request->input('email');

        Mail::send(new UserInviteMail($name, $email));
    }
    function sendAdminInviteMail(UserRegistRequest $request)
    {
        $name = '管理者の招待が届いています。';
        $email = $request->input('email');

        Mail::send(new AdminInviteMail($name, $email));
    }

    function getUser(int $id)
    {
        $user = $this->user->select(
            'id','name', 'password', 'email'
        )->from('users') ->where('id', $id)->firstOrFail();
        return $user;
    }

    function getUsers()
    {
        return $this->user->select('id','name', 'password', 'email')->from('users')->get();
    }

    function getAdmin(int $id)
    {

        $user = $this->admin->select(
            'id','name', 'password', 'email'
        )->from('admins') ->where('id', $id)->firstOrFail();
        return $user;
    }

    function getAdmins()
    {
        return $this->admin->select('id','name', 'password', 'email')->from('admins')->get();
    }

    function saveUser(UserRegistRequest $request){
        $upload_file = $request->file('icon');
        if(!empty($upload_file)) {

            // アップロード先S3フォルダ名
            $dir = 'icon';

            // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
            $s3_upload = Storage::disk('s3')->putFile('/'.$dir, $upload_file);

            // ※オプション（ファイルダウンロード、削除時に使用するS3でのファイル保存名、アップロード先のパスを取得します。）
            // アップロードファイルurlを取得
            $s3_url = Storage::disk('s3')->url($s3_upload);

         // s3_urlからS3でのファイル保存名取得
         $s3_upload_file_name = explode("/", $s3_url)[4];

         // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
         $s3_path = $dir.'/'.$s3_upload_file_name;
         exit();
      }else{
            $s3_path = '';
        }
        $this->user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'icon_image_path' => $s3_path,
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function updateUser(UserRegistRequest $request,int $id){
        $upload_file = $request->file('icon');
        if(!empty($upload_file)) {

            // アップロード先S3フォルダ名
            $dir = 'icon';

            // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
            $s3_upload = Storage::disk('s3')->putFile('/'.$dir, $upload_file);

            // ※オプション（ファイルダウンロード、削除時に使用するS3でのファイル保存名、アップロード先のパスを取得します。）
            // アップロードファイルurlを取得
            $s3_url = Storage::disk('s3')->url($s3_upload);
            // s3_urlからS3でのファイル保存名取得
            $s3_upload_file_name = explode("/", $s3_url)[4];

            // アップロード先パスを取得 ※ファイルダウンロード、削除で使用します。
            $s3_path = $dir.'/'.$s3_upload_file_name;
        }else{
            $s3_path = '';
        }

        $this->user->find($id)->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'icon_image_path' => $s3_path,
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function saveAdmin(UserRegistRequest $request){
        $this->user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function updateAdmin(UserRegistRequest $request,int $id){
        $this->user->find($id)->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->save();
    }
}
