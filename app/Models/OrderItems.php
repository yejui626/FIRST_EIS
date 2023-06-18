<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    public $table = 'order_items';
    public $timestamps = false;
    
    use HasFactory;

    

    public function PurchaseOrder() { 
        return $this->belongsTo(PurchaseOrder::class, 'order_po_id'); 
       }

       public function product() { 
        return $this->belongsTo(Product::class, 'order_item_id')->with('productCategory'); 
       }

    protected $fillable = [
        
        'order_item_id',
        'order_unit',
        'order_unitprice',
        'order_quantity',
        'delivery_date',
        
    ];
}
