<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
     protected $fillable = [
        'name',
        'email',
        'avatar',
        'message',
        'priority',
        'status',
    ];
}
