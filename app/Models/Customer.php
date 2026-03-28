<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /* Define the column to support data insert and/or update operations. */
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    /* A one-to-many relationship is established between the customers and orders tables, as a single customer can have multiple orders. */
    public function orders(){
        return $this->hasMany(Order::class);
    }

    /* A one-to-many relationship is established between the customers and alerts tables, as a single customer can have multiple alerts. */
    public function alerts(){
        return $this->hasMany(Alert::class);
    }
}
