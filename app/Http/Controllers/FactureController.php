<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Reparation;
use App\Models\Vehicule;
use Barryvdh\DomPDF\Facade\PDF;
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

        }elseif($userRole === 'client'){

            $client =Client::where('userID',auth()->user()->id)->first();

            $invoices = Facture::join('vehicles', 'factures.vehicleID', '=', 'vehicles.id')
            ->select('factures.*', 'vehicles.marke', 'vehicles.model')
            ->where('factures.clientID', $client->id)
            ->get();
            
            return view('clients.invoices',compact('invoices'));
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
    public function generatePDF($id)
{
    $invoice = Facture::join('clients', 'factures.clientID', '=', 'clients.id')
                      ->select('factures.*', 'clients.firstName', 'clients.lastName')
                      ->where('factures.id', $id)
                      ->first();

    $data = [
        'invoice' => $invoice
    ];

    $pdf = PDF::loadView('invoices.pdf.document', $data);

    return $pdf->download('invoice_' . $invoice->firstName.'_'.$invoice->lastName. '.pdf');
}
}
