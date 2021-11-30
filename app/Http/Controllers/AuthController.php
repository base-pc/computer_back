<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\User\UserRepository;


class AuthController extends Controller
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function register(RegisterUserRequest $request)
    {
        $this->user->register($request);
    }

    public function login(LoginUserRequest $request)
    {
        return $this->user->login($request);
    }
}
