<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Services\AvatarService;
use App\Services\ResetPasswordService;
use App\Services\ChangePasswordService;

class EloquentUser implements UserRepository
{
	private $model, $avatar, $reset_password, $change_password;

	public function __construct(
		User $model,
		AvatarService $avatar,
		ResetPasswordService $reset,
		ChangePasswordService $change_password
	)

	{
		$this->model           = $model;
		$this->avatar          = $avatar;
		$this->reset_password  = $reset;
		$this->change_password = $change_password;
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

	public function providerCallback($user,$social)
	{
		return $social->SocialLogin($user);

	}

	public function resetPassword($request)
	{
		return $this->reset_password->sendEmail($request);

	}

	public function changePassword($request)
	{
		return $this->change_password->process($request);
	}
}

