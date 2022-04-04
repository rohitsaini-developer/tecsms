<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Setting extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'settings';

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable = [
        'key',
        'value',
        'type',
        'display_name',
        'details',
        'tag',
        'group',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('app.date_time_format'));
    }

    public function getStatus()
    {
        return ($this->attributes['status'] == "publish" ? 'Published' : 'Unpublished');
    }
    
    // public function uploads()
    // {
    //     return $this->morphMany(Uploads::class, 'uploadsable');
    // }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
