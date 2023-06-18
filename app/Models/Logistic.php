<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    protected $table = 'logistic';
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    use HasFactory;
}
