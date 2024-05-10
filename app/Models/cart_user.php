<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'category',
        'name',
        'price',
        'quantity',
        'user_id',
        'server_id',
        'status',
        'order_processed',
        'trxid',
        'token',
    ];
}
