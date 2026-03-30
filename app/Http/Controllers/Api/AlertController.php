<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /* Function to send an alert (store in the database) based on the order ID and customer ID */
    public function send_alert(Request $request){
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'customer_id' => 'required|exists:customers,id'
        ]);

        try {
            $send_alert = Alert::create([
                'order_id' => $request->order_id,
                'customer_id' => $request->customer_id,
                'sent_at' => now()
            ]);

            return response()->json([
                'message' => 'Alert email sent successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error sending alert'
            ], 500);
        }
    }
}
