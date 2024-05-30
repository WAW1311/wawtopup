<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class category extends Model
{
    use HasFactory;

    protected $fillable = ['id_category','name'];

    protected $primaryKey = 'id_category';

    public function product(){
        return $this->hasMany(product::class, 'id_category', 'id_category');
    }
}
