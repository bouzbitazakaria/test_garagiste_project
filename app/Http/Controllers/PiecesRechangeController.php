<?php

namespace App\Http\Controllers;

use App\Exports\PiecesRechargeExport;
use App\Imports\PiecesRechargeImport;
use App\Models\PiecesRechange;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class PiecesRechangeController extends Controller
{
    public function index(){
        $spareParts = PiecesRechange::all();
        return view('spartParts.index', compact('spareParts'));
    }

    public function create(){
        return view('spartParts.create');
    }

    public function store(Request $request){
        $request->validate([
            'partName' => 'required',
            'partReference' => 'required',
            'supplier' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $spartData['partName'] = $request->partName;
        $spartData['partReference'] = $request->partReference;
        $spartData['supplier'] =$request->supplier; 
        $spartData['stock'] = $request->stock;
        $spartData['price'] = $request->price;

        $spartPart = PiecesRechange::create($spartData);

        if($spartPart){
            return redirect()->route('spareParts.index')->with(['succes' => 'spartPart added succesfully']);
        }else{
            redirect()->back()->withErrors(['error' => 'error creating spartPart']);
        }

    }

    public function edit($id){
        $sparePart = PiecesRechange::findOrFail($id);
        return view('spartParts.edit', compact('sparePart'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'partName' => 'required',
            'partReference' => 'required',
            'supplier' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $sparePart = PiecesRechange::findOrFail($id);
        $spartData = $request->only(['partName', 'partReference', 'supplier', 'price', 'stock']);

        if($sparePart->update($spartData)){
            return redirect()->route('spareParts.index')->with('success', 'Spare part updated successfully');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error updating spare part']);
        }
    }

    public function destroy($id){


        $sparePart = PiecesRechange::findOrFail($id);

        if($sparePart->delete()){
            return redirect()->route('spareParts.index')->with('success', 'Spare part removed successfully');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error removing spare part']);
        }
    }

    public function search(): View
    {

        $spareParts = PiecesRechange::where('partName', 'like', '%' . request('search') . '%')
        ->orWhere('partReference', 'like', '%' . request('search') . '%')
        ->get();

        return view('spartParts.search',compact('spareParts'));
    }


    public function export() 
    {
        return Excel::download(new PiecesRechargeExport, 'spareParts.xlsx');
    }
    
    public function import() 
    {
        Excel::import(new PiecesRechargeImport,request()->file('file'));
       
        return back();
    }
}
