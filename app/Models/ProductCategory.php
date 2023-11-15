<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Definisikan hubungan dengan model Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
