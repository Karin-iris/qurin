<?php

namespace App\UseCases;

use App\Http\Requests\UserRegistRequest;
use App\Models\QuestionCase;
use App\Models\QuestionImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    function saveUser(UserRegistRequest $request){
        $this->user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->save();
    }

    function updateUser(UserRegistRequest $request,int $id){
        $this->user->find($id)->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->save();
    }
}
