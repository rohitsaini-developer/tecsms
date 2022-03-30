<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    use HasFactory;

    public $table = 'user_tokens';

    protected $hidden = [
        'user_email_token',
        'user_phone_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'user_id',
        'user_email_token',
        'user_phone_token',
        'email_token_status',
        'phone_token_status',
        'created_at',
        'updated_at',
    ];
    
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(config('app.date_time_format'));
    }
}
