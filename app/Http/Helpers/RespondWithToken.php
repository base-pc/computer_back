<?php

use App\Models\User;

function respondWithToken($token, $request)
{
    $user = User::where('email', $request->email)
        ->first();

    return response()->json([
        'access_token' => $token,
        'user_avatar'  => $user->avatar,
        'fullname'     => $user->fullname,
        'is_admin'     => $user->is_admin,
        'token_type'   => 'bearer',
    ], 200, [], JSON_UNESCAPED_SLASHES);

}

?>
