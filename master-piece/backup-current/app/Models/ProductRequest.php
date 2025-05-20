<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_name',
        'phone',
        'address',
        'notes',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'status' => 'string'
    ];
}
