<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sub_product;
use App\Models\category;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['product_id','name','src','id_category'];

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Definisikan relasi ke model SubProduct
    public function sub_product()
    {
        return $this->hasMany(sub_product::class, 'id_product', 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(category::class, 'id_category', 'id_category');
    }
}
