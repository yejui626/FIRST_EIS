<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{   
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'supplier_details',
        'supplier_phone',
        'supplier_address',
        'supplier_address_state',
        'supplier_address_city',
        'supplier_address_postcode',
    ];
}
