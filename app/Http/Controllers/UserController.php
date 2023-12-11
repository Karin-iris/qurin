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

    public function __construct()
    {
        $this->userUC = new UserUseCase();
    }


    public function index(): View
    {
        $users = $this->userUC->getUsers();
        return view('user.index', compact('users'));
    }

    public function admin_index(): View
    {
        $admins = $this->userUC->getAdmins();
        return view('user.admin_index', compact('admins'));
    }

    public function invite(): View
    {
        return view('user.invite');
    }
    public function send_invite(UserRegistRequest $request){
        $this->userUC->sendInviteMail($request);
        return Redirect::route('user.invite')->with('question', 'saved');//

    }
    public function user_regist($token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('user.regist');
    }
    public function admin_invite(): View
    {
        return view('user.admin_invite');
    }
    public function send_admin_invite(UserRegistRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->userUC->sendAdminInviteMail($request);
        return Redirect::route('user.admin_invite')->with('question', 'saved');//
    }
    public function admin_regist($token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('user.admin_regist');
    }

    public function create()
    {

        return view('user.create');
    }

    public function store(UserRegistRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->userUC->saveUser($request);
        return Redirect::route('user.create')->with('user', 'saved');
    }

    public function edit(int $id): View
    {
        $user = $this->userUC->getUser($id);
        return view('user.edit', compact('user'));
    }

    public function update(UserRegistRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $this->userUC->updateUser($request,$id);
        return Redirect::route('user.edit', $id)->with('user', 'saved');
    }
    public function admin_edit(int $id): View
    {
        $admin = $this->userUC->getAdmin($id);
        return view('user.admin_edit', compact('admin'));
    }

    public function admin_update(UserRegistRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $this->userUC->updateAdmin($request,$id);
        return Redirect::route('user.edit', $id)->with('user', 'saved');
    }
}
