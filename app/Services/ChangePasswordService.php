<?php
namespace App\Services;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChangePasswordService
{

    public function process(ChangePasswordRequest $request)
    {
       $this->changePassword($request);      

    }

    private function changePassword($request)
    {
        $user = User::where('email', $request->email)->first();

        $row = DB::table('password_resets')
            ->where(['email'=>$request->email, 'token'=>$request->reset_token]);

        $user->update(['password'=>$request->password]);

        $row->delete();
    }
}
?>

