<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Services\AvatarService;
use JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'avatar',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function products(){

        return $this->hasMany(Product::class);
    }

    public function googleCallback($user)
    {

        $fullname = $user->getName();
        $avatar   = $user->getAvatar();
        $email    = $user->getEmail();


        $this->user = User::where([
            'fullname' => $fullname,
            'email'    => $email,
            'avatar'   => $avatar,
        ])->first();


        $user = User::firstOrCreate([
            'fullname' => $fullname,
            'email'    => $email,
            'avatar'   => $avatar,
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'access_token' => $token,
            'fullname'     => $fullname,
            'email'        => $email,
            'avatar'       => $avatar,
        ];
    }

    public function setDefaultAvatar ($user)
    {

        $avatar = new AvatarService;

        $user->avatar = $avatar->generate($user);

        $user->save();
    }
}
