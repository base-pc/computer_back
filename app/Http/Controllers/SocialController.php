<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Repositories\User\UserRepository;
use App\Services\SocialService;
use App\Http\Requests\SocialLoginRequest;

class SocialController extends Controller
{
    //
    private $user, $social;

    public function __construct(UserRepository $user, SocialService $social)
    {
        $this->user   = $user;
        $this->social = $social;
    }

    public function handleProviderCallback(SocialLoginRequest $request)
    {
        $token    = $request->input('_token');
        $provider = $request->input('_provider');

        try {
            $user =  Socialite::driver($provider)
                ->stateless()->userFromToken($token);
        } catch (\Exception $e) {
            abort(401, 'Token is invalid');
        }

        $social_user = $this->user->providerCallback($user, $this->social);

        return response()->json(['social_user' => $social_user]);
    }
}
