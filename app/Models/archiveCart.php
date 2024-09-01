<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveCart extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'archive_cart';

    // The attributes that are mass assignable.
    protected $fillable = [
        'string1',
        'string2',
        'string3',
        'string4',
        'string5',
        'string6',
        'string7',
        'string8',
        'string9',
        'string10',
        'string11',
        'string12',
        'string13',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [];

    // The attributes that should be cast to native types.
    protected $casts = [];
}
