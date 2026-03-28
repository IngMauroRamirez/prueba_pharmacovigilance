<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /* Define the column to support data insert and/or update operations. */
    protected $fillable = [
        'customer_id',
        'purchase_date'
    ];

    /* Cast the value to match the format required by the field. */
    protected $casts = [
        'purchase_date' => 'date'
    ];

    /* A belongs-to relationship is defined between the orders and customers tables to indicate that each order belongs to a customer. */
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    /* A one-to-many relationship is established between the orders and order_items tables to indicate that a single order can contain multiple items (medications). */
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
