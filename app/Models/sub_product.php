<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class sub_product extends Model
{
    protected $table = 'sub_products';
    protected $primaryKey = 'id_sub_product';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_sub_product','name','assets','href','howto','fill_data_id','checkign_on','checkign','id_product'];
    use HasFactory;
    

    public function product()
    {
        return $this->belongsTo(product::class, 'id_product', 'product_id');
    }
}
