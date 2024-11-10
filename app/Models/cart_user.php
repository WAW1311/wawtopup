<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tripay_reference',
        'no_hp',
        'product_id',
        'category',
        'name',
        'price',
        'quantity',
        'user_id',
        'server_id',
        'method',
        'method_name',
        'fee_customer',
        'subtotal',
        'status',
        'order_processed',
        'trxid',
        'url_checkout',
        'created_at',
        'updated_at',
    ];
}
