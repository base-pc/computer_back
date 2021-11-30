<?php

namespace App\Repositories\User;

use App\Services\SocialService;

interface UserRepository
{
	public function register($request);

	public function login($request);

	public function setAvatar($user);

	public function providerCallback($user, SocialService $social);

}

