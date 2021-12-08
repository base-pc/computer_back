<?php

namespace App\Services;

use App\Models\User;
use JWTAuth;

class SocialService
{
    public function SocialLogin($user)
    {
        $name     = $user->getName();
        $avatar   = $user->getAvatar();
        $email    = $user->getEmail();
        $is_admin = false;


        $this->user = User::where([
            'fullname' => $name,
            'email'    => $email,
            'avatar'   => $avatar,
            'is_admin' => $is_admin,
        ])->first();


        $user = User::firstOrCreate([
            'fullname' => $name,
            'email'    => $email,
            'avatar'   => $avatar,
            'is_admin' => $is_admin,
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'access_token' => $token,
            'fullname'     => $name,
            'email'        => $email,
            'avatar'       => $avatar,
            'is_admin'     => $is_admin,
        ];
    }
}

