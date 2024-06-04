<?php

namespace App\Http\Controllers;

use App\Models\PiecesRechange;
use App\Models\Reparation;
use Illuminate\Http\Request;

class repairSparePartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'spare_part_id' => 'required|exists:sparePart,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $repair = Reparation::findOrFail($request->repair_id);
        $sparePart = PiecesRechange::findOrFail($request->spare_part_id);

        if ($sparePart->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock for the selected spare part');
        }

        // Reduce the stock of the spare part
        $sparePart->stock -= $request->quantity;
        $sparePart->save();
        
        $repair->spareParts()->attach($sparePart->id, ['quantity' => $request->quantity]);



        return back()->with('success', 'Spare part added successfully');
    }
}
