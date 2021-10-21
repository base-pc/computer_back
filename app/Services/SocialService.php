<?php

namespace App\Services;

use App\Models\User;
use JWTAuth;

class SocialService
{
    public function SocialLogin($user)
    {
        $name   = $user->getName();
        $avatar = $user->getAvatar();
        $email  = $user->getEmail();


        $this->user = User::where([
            'name'   => $name,
            'email'  => $email,
            'avatar' => $avatar,
        ])->first();


        $user = User::firstOrCreate([
            'name'   => $name,
            'email'  => $email,
            'avatar' => $avatar,
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'access_token' => $token,
            'name'         => $name,
            'email'        => $email,
            'avatar'       => $avatar,
        ];
    }
}

