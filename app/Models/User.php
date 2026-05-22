<?php

namespace App\Models;
use App\Models\Order;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Settings;

use App\Notifications\UserNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'country',
        'address',
        'city',
        'postal_code',
        'image',
        'gender',
        'age',
        'role',
        'region',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function settings()
    {
        return $this->hasMany(Settings::class);
    }
    public function deliveries()
    {
        return $this->hasMany(Order::class, 'delivery_user_id');
    }
     protected static function booted()
    {
        static::created(function ($user) {

            // only notify if created user is NOT admin
            if ($user->role === 'user') {

                $admins = User::where('role', 'admin')->get();

                foreach ($admins as $admin) {
                    $admin->notify(new UserNotification($user));
                }
            }

        });
    }

}