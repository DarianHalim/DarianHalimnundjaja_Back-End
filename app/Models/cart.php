<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'barang_id',
        'quantity',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
