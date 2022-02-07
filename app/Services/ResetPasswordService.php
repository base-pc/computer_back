<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ResetPasswordService
{

    public function sendEmail(Request $request)
    {
        if(!$this->validateEmail($request->email))
        {
            return $this->faildResponse();

        }
        $this->send($request->email);

        return $this->successResponse();
    }

    public function validateEmail($email):bool
    {

        return !!User::where('email', $email)->first();
    }

    public function faildResponse()
    {
        return response()
            ->json(
                ['error' => 'Email doesnt found in database'],
                Response::HTTP_NOT_FOUND
            );
    }

    public function successResponse()
    {
        return response()
            ->json(
                ['data' => 'Reset email is send'],
                Response::HTTP_OK
            );

    }

    public function send($email)
    {
        $token = $this->createToken($email);

        Mail::to($email)->send(new ResetPasswordMail($token));
    }

    public function createToken($email)
    {
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if($oldToken)
        {
            return $oldToken->token;
        }

        $token = Str::random(60);

        $this->saveToken($token, $email);

        return $token;
    }

    public function saveToken($token ,$email)
    {

        DB::table('password_resets')->insert([
            'email'      => $email,
            'token'      => $token,
            'created_at' => Carbon::now()

        ]);

    }

}

?>
