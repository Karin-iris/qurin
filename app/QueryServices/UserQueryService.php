<?php

namespace App\QueryServices;

use App\Exceptions\TokenException;
use App\Models\AdminInvitation;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserQueryService extends QueryService
{
    protected User $user;
    protected Invitation $invitation;
    protected AdminInvitation $admin_invitation;
    function __construct(){
        $this->user = new User;
        $this->invitation = new Invitation;
        $this->admin_invitation = new AdminInvitation;
    }
    function getPaginate(Request $request){

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
