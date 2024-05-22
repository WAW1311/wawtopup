<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sub_product;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['product_id','name','src'];

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Definisikan relasi ke model SubProduct
    public function sub_products()
    {
        return $this->hasMany(sub_product::class, 'id_product', 'product_id');
    }
}
