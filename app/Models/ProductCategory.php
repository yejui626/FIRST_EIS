<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $table = 'product_category';
    public $timestamps = false;
    protected $primaryKey = 'category_id';

    public function product()
    {
        return $this->hasMany(Product::class, 'product_category');
    }

    protected $fillable = [
        'category_name',
        'specs1',
        'specs2',
        'specs3',
    ];
}
