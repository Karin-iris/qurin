<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Invitation;
use App\Models\AdminInvitation;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Exceptions\TokenException;

class UserRepository extends Repository
{
    protected Invitation $invitation;
    public AdminInvitation $admin_invitation;

    public function __construct()
    {
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

    public function getEmailFromToken($token): ?string
    {
        return $this->handleExceptions(function () use ($token) {
            $invitation = $this->invitation->where('token', $token)->first();
            return $invitation ? $invitation->email : throw new TokenException();
        });
    }

    public function getEmailFromAdminToken($token): ?string
    {
        return $this->handleExceptions(function () use ($token) {
            $invitation = $this->admin_invitation->where('token', $token)->first();
            return $invitation ? $invitation->email : throw new TokenException();
        });
    }
}

