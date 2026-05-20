<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'avatar',
        'phone',
        'country',
        'orders',
        'spent',
        'status',
    ];
}
