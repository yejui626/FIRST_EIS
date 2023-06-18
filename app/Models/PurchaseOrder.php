<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{

    public $table = 'purchase_order';
    protected $primaryKey = 'po_id';
    use HasFactory;

    public function supplier() { 
        return $this->belongsTo(Supplier::class, 'supplier_id'); 
       }
       
    public function OrderItems() { 
        return $this->hasMany(OrderItems::class, 'order_po_id'); 
       }
       
    protected $fillable = [
        'po_no',
        'supplier_id',
        'discount_percentage',
        'buyer',
        'requestor',
        'discount_amount',
        'tax_percentage',
        'tax_amount',
        'notes',
        'status',
       
    ];
}
