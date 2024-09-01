<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedCart extends Model
{
    use HasFactory;

    protected $table = 'saved_carts';

    // Define fillable fields to allow mass assignment
    protected $fillable = [
        'order_number',
        'user',
        'alamat_pengiriman',
        'kode_pos',
        'barang',
        'quantity',
    ];

    // If you have timestamps
    public $timestamps = true;
}
