<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [

        'transaction_id',

        'customer_name',

        'customer_email',

        'customer_avatar',

        'product_name',

        'amount',

        'payment_method',

        'status',

        'transaction_date',

    ];
}
