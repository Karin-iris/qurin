<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\UseCases\UserUseCase;
use JetBrains\PhpStorm\Pure;
use App\Http\Requests\UserRegistRequest;

class UserController extends Controller
{
    public UserUseCase $userUC;

    #[Pure] public function __construct()
    {
        $this->userUC = new UserUseCase();
    }


    public function index(): View
    {
        $users = $this->userUC->getUsers();
        return view('user.index', compact('users'));
    }

    public function invite(): View
    {
        return view('user.invite');
    }
    public function send_invite(UserRegistRequest $request){
        $this->userUC->sendRegistMail($request);
        return Redirect::route('user.invite')->with('question', 'saved');//

    }

    public function create()
    {

        return view('user.create');
    }

    public function store(UserRegistRequest $request){
        $this->userUC->saveUser($request);
        return Redirect::route('user.create')->with('user', 'saved');
    }

    public function edit(int $id): View
    {
        $user = $this->userUC->getUser($id);
        return view('user.edit', compact('user'));
    }

    public function update(UserRegistRequest $request, string $id){
        $this->userUC->updateUser($request,$id);
        return Redirect::route('user.edit', $id)->with('user', 'saved');
    }
}
