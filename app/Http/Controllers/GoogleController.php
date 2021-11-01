<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Repositories\User\UserRepository;
use App\Services\SocialService;

class GoogleController extends Controller
{
    private $user, $social;

    public function __construct(UserRepository $user, SocialService $social)
    {
        $this->user   = $user;
        $this->social = $social;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $user =  Socialite::driver('google')->stateless()->user();

        $google_user = $this->user->googleCallback($user, $this->social);

        return response()->json(['google_user' => $google_user ]);
    }
}

