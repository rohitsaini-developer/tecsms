<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Setting extends Model
{

    protected $fillable = [
        'value',
        'details',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(config('app.date_time_format'));
    }
}
