<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    protected $table = 'grn';
    protected $fillable = [
        'grn_number',
        'purchase_order_no',
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
}

class GRNItem extends Model
{
    protected $table = 'grn_items';
    protected $fillable = [
        'grn_id',
        'product_received',
        'qty',
        'product_uom',
        'description',
    ];

    public function grn()
    {
        return $this->belongsTo(GRN::class, 'grn_id');
    }
}
