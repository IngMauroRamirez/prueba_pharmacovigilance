<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class MedicationController extends Controller
{
    
    /* 
        This function returns all orders that contain a specific medication (by its batch) and 
        whose purchase date falls within a given range, including customer and medication details, sorted from the most recent to the oldest.
     */
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
            'items' => function ($query) use ($validated) {
                $query->whereHas('medication', function ($q) use ($validated) {
                    $q->where('lot_number', $validated['lot']);
                })->with(['medication' => function ($q) use ($validated) {
                    $q->where('lot_number', $validated['lot']);
                }]);
            }
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

    /* Function to return the orders search view. */
    public function showSeach(){
        return view('pharmacovigilance.search');
    }
}
