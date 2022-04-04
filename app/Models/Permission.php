<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
        'controller_name',
        'function_name',
        'route_name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}