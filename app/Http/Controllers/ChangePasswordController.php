<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\User\UserRepository;

class ChangePasswordController extends Controller
{

    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function changeUserPassword(ChangePasswordRequest $request)

    {
        return $this->user->changePassword($request);

    }
}
