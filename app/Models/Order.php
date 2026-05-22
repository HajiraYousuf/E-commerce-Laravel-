<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Customer;
use App\Notifications\OrderNotification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'shipping_address',
        'phone',
        'delivery_user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function rider()
    {
        return $this->belongsTo(User::class, 'delivery_user_id');
    }
    protected static function booted()
    {
        static::created(function ($order) {

            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {

                $admin->notify(
                    new OrderNotification($order)
                );

            }

        });
    }
}