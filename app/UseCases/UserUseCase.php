<?php

namespace App\UseCases;

use App\Http\Requests\UserRegistRequest;
use App\Models\QuestionCase;
use App\Models\QuestionImage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use App\Mail\TestMail;

class UserUseCase extends UseCase
{

    public User $user;

    function __construct()
    {
        $this->user = new User();
    }

    function sendRegistMail(UserRegistRequest $request)
    {
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new TestMail($name, $email));
    }

    function getUsers()
    {
        return $this->user->select('name', 'password', 'email')->from('users')->get();
    }
}
