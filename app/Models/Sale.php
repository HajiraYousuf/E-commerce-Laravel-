<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;

class Sale extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'category',
        'quantity',
        'price',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}