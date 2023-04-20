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
        return view('user.index');
    }

    public function invite(): View
    {
        return view('user.invite');
    }
    public function send_invite(UserRegistRequest $request){
        $this->userUC->sendRegistMail($request);
        return Redirect::route('user.invite')->with('question', 'saved');//

    }
}
