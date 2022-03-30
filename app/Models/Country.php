<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;    

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(config('app.date_time_format'));
    }
}
