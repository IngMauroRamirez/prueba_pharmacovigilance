<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    /* Define the column to support data insert and/or update operations. */
    protected $fillable = [
        'name',
        'lot_number'
    ];

    /* A one-to-many relationship is established between the medications and order_items tables, as a single medication can be included in multiple orders. */
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
