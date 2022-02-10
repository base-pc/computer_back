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
        $this->user->resetPassword($request);

        return response()->json(['success' => 'Email was send']);

    }

}
