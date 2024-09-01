<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'alamat_pengiriman', 'kode_pos', 'order_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Buat  custom order number seperti  'order1', 'order2', etc.
            $latestOrder = static::latest()->first();
            $nextOrderNumber = $latestOrder ? intval(str_replace('order', '', $latestOrder->order_number)) + 1 : 1;
            $order->order_number = 'order' . $nextOrderNumber;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}