<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function quantity(){
        return $this->hasMany(Quantity::class, 'quantity_productid');
    }
    
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category');
    }

    

    protected $fillable = [
        'product_name',
        'product_category',
        'product_code',
        'product_details',
        'product_sellingprice',
        'product_supplierprice',
        'product_img1',
        'product_img2',
        'product_img3',
        'product_quantity'
    ];
}
