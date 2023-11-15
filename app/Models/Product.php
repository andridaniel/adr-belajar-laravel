<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'category_id',
        'product_code',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Define the relationship with ProductCategory
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function index()
{
    $products = Product::all(); // Contoh kode untuk mengambil semua produk dari model Product
    return view('pages.products', compact('products'));
}
    
}
