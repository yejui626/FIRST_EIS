<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest_Items extends Model
{
    protected $table = 'request_items';
    protected $primaryKey = 'id';
    protected $fillable = ['pr_id', 'product_id', 'delivery_date', 'product_quantity', 'uom', 'product_unitprice'];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class, 'pr_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
