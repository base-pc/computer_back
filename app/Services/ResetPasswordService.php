<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ResetPasswordService
{

    public function sendEmail(Request $request)
    {
        $this->send($request->email);

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
