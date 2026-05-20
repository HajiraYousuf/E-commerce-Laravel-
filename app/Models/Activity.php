<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user',
        'email',
        'avatar',
        'action',
        'module',
        'ip',
        'device',
        'status',
        'date',
        'time',
    ];
}
