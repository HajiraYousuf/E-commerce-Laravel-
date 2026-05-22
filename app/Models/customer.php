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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
