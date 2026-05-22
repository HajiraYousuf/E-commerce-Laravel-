<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
