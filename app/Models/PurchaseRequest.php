<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    public $incrementing = false;

    protected $table = 'purchaserequest';
    protected $primaryKey = 'id'; // Update the primary key column name
    protected $fillable = ['status', 'requestor', 'supplier_id', 'discount_percentage', 'discount_amount', 'tax_percentage','tax_amount','total_amount', 'notes'];

    public function items()
    {
        return $this->hasMany(PurchaseRequest_Items::class, 'pr_id', 'id');
    }

    public function supplier() 
    { 
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id'); 
    }

    
}
