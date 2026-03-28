<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class MedicationController extends Controller
{
    public function search(Request $request){
        $validated = $request->validate([
            'lot' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $start_date = $validated['start_date'] ?? Carbon::now()->subDays(30);
        $end_date = $validated['end_date'] ?? Carbon::now();

        $orders_list = Order::whereBetween('purchase_date', [$start_date, $end_date])
        ->whereHas('items.medication', function ($query) use ($validated) {
            $query->where('lot_number', $validated['lot']);
        })
        ->with([
            'customer',
            'items.medication'
        ])
        ->orderBy('purchase_date', 'desc')
        ->get();

        if ($orders_list->isEmpty()) {
            return response()->json([
                'data' => [],
                'message' => 'There are no results for your search.'
            ]);
        }

        return response()->json([
            'data' => $orders_list
        ]);
    }
}
