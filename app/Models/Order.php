<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // Order.php

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function items()
    {
        return $this->hasMany(Items::class, 'order_id');
    }
}
