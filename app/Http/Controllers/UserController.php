<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserRegisterRequest;
use App\Http\Requests\Users\AdminRegisterRequest;
use App\UseCases\UserConfigUseCase;
use App\UseCases\UserUseCase;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserController extends Controller
{
    public UserUseCase $userUC;
    public UserConfigUseCase $userConfigUC;

    public function __construct()
    {
        $this->userUC = new UserUseCase();
        $this->userConfigUC = new UserConfigUseCase();
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

    public function send_invite(UserRegisterRequest $request): RedirectResponse
    {
        $this->userUC->sendInviteMail($request);
        return Redirect::route('user.invite')->with('question', 'saved');//

    }

    public function user_register(string $token): View
    {
        $email = $this->userUC->getEmailFromToken($token);
        return view('user.register', compact('email', 'token'));
    }

    public function store_user_register(UserRegisterRequest $request, string $token): RedirectResponse
    {
        try {
            $this->userUC->setUserFromToken($request, $token);
            return Redirect::route('user.user_register')->with('register', 'saved');
        } catch (Exception $e) {
            return Redirect::route('user.error')->with('error', $e->message());
        }
    }

    public function admin_invite(): View
    {
        return view('user.admin_invite');
    }

    public function send_admin_invite(AdminRegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->userUC->sendAdminInviteMail($request);
        return Redirect::route('user.admin_invite')->with('question', 'saved');//
    }

    public function admin_register(string $token): View
    {
        $email = $this->userUC->getEmailFromAdminToken($token);
        return view('user.admin_register', compact('email', 'token'));
    }

    public function store_admin_register(AdminRegisterRequest $request, $token): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->userUC->setAdminFromToken($request, $token);
            return Redirect::route('user.admin_register')->with('register', 'saved');
        } catch (Exception $e) {
            return Redirect::route('user.error')->with('error', $e->message());//
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $status = $this->userUC->add($request);
        return Redirect::route('user.index')->with('status', $status);
    }

    public function edit(int $id): View
    {
        $user = $this->userUC->getUser($id);
        return view('user.edit', compact('user'));
    }

    public function update(UserRegisterRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $status = $this->userUC->update($request, $id);
        return Redirect::route('user.index')->with('status', $status);
    }

    public function admin_edit(int $id): View
    {

        $admin = $this->userUC->getAdmin($id);
        return view('user.admin_edit', compact('admin'));
    }

    public function admin_update(AdminRegisterRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $status = $this->userUC->updateAdmin($request, $id);
        return Redirect::route('user.admin_index', $id)->with('status', $status);
    }

    public function admin_config_edit(): View
    {
        try {
            $admins = $this->userConfigUC->getAdminConfig();
            [$qr_image, $secret] = $this->userUC->displayMFA(Auth::guard('admin')->id());
            return view('user.admin_config_edit', compact('admins', 'qr_image', 'secret'));
        } catch (Exception $e) {
            $error = $e->message();
            return view('user.error',compact('error'));//
        }
    }
}
