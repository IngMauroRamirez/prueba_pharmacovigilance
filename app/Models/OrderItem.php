<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /* Define the column to support data insert and/or update operations. */
    protected $fillable = [
        'order_id',
        'medication_id'
    ];

    /* A belongs-to relationship is defined between the order_items and orders tables to indicate that each order item belongs to a specific order. */
    public function order(){
        return $this->belongsTo(Order::class);
    }

    /* A belongs-to relationship is defined between the order_items and medications tables to indicate that each record in the order_items table corresponds to a specific medication. */
    public function medication(){
        return $this->belongsTo(Medication::class);
    }
}
