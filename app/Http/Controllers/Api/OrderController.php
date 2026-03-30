<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /* Function to return the information of an order based on the batch number. */
    public function show_order($id, $lot_number){
        $order = Order::with([
            'customer',
            'items' => function ($query) use ($lot_number) {
                $query->whereHas('medication', function ($q) use ($lot_number){
                    $q->where('lot_number', $lot_number);
                })->with(['medication' => function ($q) use ($lot_number) {
                    $q->where('lot_number', $lot_number);
                }]);
            }
        ])->find($id);

        if(!$order){
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'order' => $order
        ]);
    }
}
