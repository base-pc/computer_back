<?php

namespace App\Services;

use App\Models\User;
use App\Http\Controllers\GoogleController;
use JWTAuth;


class GoogleService
{
    public function Glogin($user)
    {

        $fullname = $user->getName();
        $avatar   = $user->getAvatar();

        $email    = $user->getEmail();


        $this->user = User::where([
            'fullname' => $fullname,
            'email'    => $email,
            'avatar'   => $avatar,
        ])->first();


        $user = User::firstOrCreate([
            'fullname' => $fullname,
            'email'    => $email,
            'avatar'   => $avatar,
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'access_token' => $token,
            'fullname'     => $fullname,
            'email'        => $email,
            'avatar'       => $avatar,
        ];
    }
}
















?>
