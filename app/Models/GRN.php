<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    protected $table = 'grn';
    protected $fillable = [
        'grn_number',
        'po_id',
        'supplier_id',
        'received_date',
        'custdelivery_date',
        'to_grn',
        'recipient_grn',
        'total_qty',
    ];

    public function grnItems()
    {
        return $this->hasMany(GRNItem::class, 'grn_id');
    }

    public function supplier() 
    { 
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id'); 
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

class GRNItem extends Model
{
    protected $table = 'grn_items';
    protected $fillable = [
        'grn_id',
        'product_id',
        'qty',
        'product_uom',
        'description',
    ];

    public function grn()
    {
        return $this->belongsTo(GRN::class, 'grn_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    


}