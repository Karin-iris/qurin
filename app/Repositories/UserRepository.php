<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Invitation;
use App\Models\AdminInvitation;

class UserRepository extends Repository
{
    public Invitation $Invitation;
    public AdminInvitation $AdminInvitation;

    public function __construct()
    {
        //$this->Invitation = new Invitation;
        $this->AdminInvitation = new AdminInvitation;
    }

    public function create(array $data)
    {
        // ユーザー情報をデータベースに保存
    }

    public function saveToken($email, $token): void
    {
        $this->Invitation = new Invitation;
        $this->Invitation->fill([
            'email' => $email,
            'token' => $token
        ])->save();
    }
}

