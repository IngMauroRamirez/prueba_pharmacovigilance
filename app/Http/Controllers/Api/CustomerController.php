<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show_customer($id){
        $customer = Customer::find($id);

        if(!$customer){
            return response()->json([
                'message' => 'Customer not found'
            ], 404);
        }

        return response()->json([
            'customer' => $customer
        ]);
    }
}
