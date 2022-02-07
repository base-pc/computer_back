<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function process(ChangePasswordRequest $request)
    {

        return $this->getPasswordResetTableRow($request)->count() > 0 ? $this->changePassword($request) :
            $this->tokenNotFountResponse();

    }
    private function getPasswordResetTableRow($request)
    {
        return DB::table('password_resets')
            ->where(['email'=>$request->email, 'token' => $request->reset_token]);
    }

    private function tokenNotFountResponse()
    {

        return response()->json(['error'=>'Token or email is incorrect'],
            Response::HTTP_NOT_FOUND);

    }

    private function changePassword($request)
    {

        $user = User::where('email', $request->email)->first();

        $user->update(['password'=>$request->password]);

        $this->getPasswordResetTableRow($request)->delete();

        return response()->json(['data' => 'Password Successfully Changed'],
            Response::HTTP_CREATED);

    }
}
