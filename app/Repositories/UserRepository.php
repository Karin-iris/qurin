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

    public function create(array $data)
    {
        // ユーザー情報をデータベースに保存
    }

    public function saveToken($email, $token): void
    {
        $this->invitation->fill([
            'email' => $email,
            'token' => $token
        ])->save();
    }

    public function saveAdminToken($email, $token): void
    {
        $this->admin_invitation->fill([
            'email' => $email,
            'token' => $token
        ])->save();
    }
    public function setUser(UserRegisterRequest $request): void
    {
        $this->user->fill([
            'name' => Crypt::encryptString($request->input('name')),
            'email' => $request->input('email'),
            'icon_image_path' => "",
            'password' => Hash::make($request->input('password'))
        ])->save();
    }
    public function setAdmin(AdminRegisterRequest $request): void
    {
        $this->admin->fill([
            'name' => Crypt::encryptString($request->input('name')),
            'email' => $request->input('email'),
            'icon_image_path' => "",
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

}

