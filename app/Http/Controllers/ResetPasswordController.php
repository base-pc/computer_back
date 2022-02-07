<?php

namespace App\Http\Controllers;
use App\Repositories\User\UserRepository;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function resetUserPassword(Request $request)
    {
        return $this->user->resetPassword($request);

    }

}
