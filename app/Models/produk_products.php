<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk_products extends Model
{
    protected $fillable = ['id','category','name','type','status','note','price'];
    use HasFactory;
}
