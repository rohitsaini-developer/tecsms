<?php

namespace App\Models;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable;

    public $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
        'phone_number_verified_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'phone_number',
        'phone_country_id',
        'phone_number_verified_at',
        'register_type',
        'social_login_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
    ];
    
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(config('app.date_time_format'));
    }

    // reset password notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userToken()
    {
        return $this->hasOne(UserToken::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'phone_country_id', 'id');
    }
}
