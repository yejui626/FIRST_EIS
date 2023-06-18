<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    public $table = 'quantity';
    protected $primaryKey = 'quantity_id';
    use HasFactory;

    public function product() { 
        return $this->belongsTo(Product::class, 'quantity_productid'); 
       }

    protected $fillable = [
        
        'quantity_productid',
        'quantity_product',
        
        
        
    ];
}
