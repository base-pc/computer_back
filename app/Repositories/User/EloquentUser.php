<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Services\AvatarService;

class EloquentUser implements UserRepository
{
	private $model, $avatar;

	public function __construct(User $model, AvatarService $avatar)
	{
		$this->model  = $model;
		$this->avatar = $avatar;
	}

	public function register($request)
	{
		$user = $this->model = User::create($request->validated());

		$this->setAvatar($user);
	}

	public function login($request)
	{
		if (!$token = guard()->attempt($request->validated())) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}
		return respondWithToken($token, $request);
	}

	public function setAvatar($user)
	{
		$this->model->avatar = $this->avatar->generate($user);

		$this->model->save();
	}

	public function googleCallback($user,$social)
	{
		return $social->SocialLogin($user);

	}
}

