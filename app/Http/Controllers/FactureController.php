<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Reparation;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index(){

        $userRole=auth()->user()->role;

        if($userRole === 'admin'){
            $invoices = Facture::join('clients', 'factures.clientID', '=', 'clients.id')
            ->select('factures.*', 'clients.firstName', 'clients.lastName')
            ->get();
            return view('invoices.index',compact('invoices'));
        }

        
    }

    public function store(Request $request){

        $request->validate([
            'repair_id'=>'required',
            'sparePartsAmount' => 'nullable',
            'additionalCharges'=>'required'
        ]);
        if($request->sparePartsAmount){
            $totalAmount = $request->additionalCharges + $request->sparePartsAmount;
        }else{
            $totalAmount = $request->additionalCharges;

        };

        $repair = Reparation::where('id',$request->repair_id)->first();
        $vehicle =Vehicule::where('id', $$repair->vehicleID)->first();

        if($vehicle){
            $invoice = Facture::create([
                'repairID'=> $request->repair_id,
                'clientID' => $vehicle->clientID,
                'additionalCharges' =>$request->additionalCharges,
                'totalAmount' => $totalAmount
            ]);

            if($invoice){
                return redirect()->back()->with(['success'=>'invoice created']);
            }
        }
        
    }
}
