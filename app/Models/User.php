<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function follows()
    {
        return $this->hasMany(Follow::class, 'sender', 'id');
    }

    // フォローしているか
    public function isFollowing($id)
    {
        return (bool) $this->follows()->where('receiver', '=', $id)->first();
    }

    public function following_list($id)
    {

        return $this->follows()->join('users', 'users.id', 'follows.receiver')->where('receiver', '=', $id)->get();
        // return $this->follows()->join('users', 'users.id', 'follows.')
        // return $this->follows()->join('profiles', 'profiles.user_id', 'follows.receiver')->join('users', 'users.id', 'profiles.user_id')->where('receiver', '=', $id)->get();
    }
}
