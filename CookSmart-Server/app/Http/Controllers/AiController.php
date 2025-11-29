<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PantryItem;

class AiController extends Controller
{
    public function expiringSoon(Request $request)
    {
        $request->validate([
            'household_id' => 'required|integer'
        ]);

        $householdId = $request->household_id;

        $items = PantryItem::with('ingredient')
            ->where('household_id', $householdId)
            ->whereDate('expiry_date', '<=', now()->addDays(5))
            ->orderBy('expiry_date')
            ->get();

        return response()->json([
            'status' => 'success',
            'household_id' => $householdId,
            'payload' => $items
        ]);
    }
}
