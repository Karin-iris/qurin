<?php

namespace App\UseCases;

use App\Http\Requests\UserRegistRequest;
use Illuminate\Support\Facades\Mail;

use App\Mail\TestMail;

class UserUseCase extends UseCase{
    function sendRegistMail(UserRegistRequest $request){
        $name = 'テスト ユーザー';
        $email = 'test@example.com';

        Mail::send(new TestMail($name, $email));
    }
}
