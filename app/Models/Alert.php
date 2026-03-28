<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    /* Define the column to support data insert and/or update operations. */
    protected $fillable = [
        'customer_id',
        'order_id',
        'sent_at'
    ];

    /* Cast the value to match the format required by the field. */
    protected $casts = [
        'sent_at' => 'datetime'
    ];
    
    /* A belongs-to relationship is defined between the alerts and customers tables to indicate that each alert corresponds to a single customer. */
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    /* A belongs-to relationship is defined between the alerts and customers tables to indicate that each alert corresponds to a single order. */
    public function order (){
        return $this->belongsTo(Order:: class);
    }
}
