<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;
     protected $filable = [
        'external_id',
        'discount_code',
        'subtotal',
        'discount',
        'tax',
        'total',
     ];

     public function items()
     {
        return $this->hasMany(OrderItem::class);
     }
}
