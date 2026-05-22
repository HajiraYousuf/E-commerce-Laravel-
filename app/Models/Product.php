<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Sale;
use App\Notifications\ProductNotification;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'price',
        'stock',
        'sold',
        'description',
        'image',
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    protected static function booted()
    {
        static::created(function ($product) {

            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                $admin->notify(
                    new ProductNotification($product)
                );
            }

        });
    }
}