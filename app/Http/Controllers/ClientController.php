<?php

namespace App\Http\Controllers;

use App\Exports\ClientExport;
use App\Imports\ClientImport;
use App\Mail\NotificationMail;
use App\Mail\RemoveMail;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Reparation;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('vehicles')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $userData['username'] = $request->username;
        $userData['email'] = $request->email;
        $userData['password'] = bcrypt($request->password); 
        $userData['role'] = 'client';

        $user = User::create($userData);
        if ($user) {
           
            $clientData['firstName'] = $request->firstName;
            $clientData['lastName'] = $request->lastName;
            $clientData['address'] = $request->address;
            $clientData['phoneNumber'] = $request->phoneNumber;
            $clientData['userID'] = $user->id;

            $client = Client::create($clientData);

            $mailData = [
                'title' => 'Mail From Admin',   
                'username' => $request->username,
                'password' => $request->password
            ];

            Mail::to($request->email)->send(new NotificationMail($mailData));

            if ($client) {
                return redirect()->route('clients.index');
            }
        } else {
            redirect()->back()->withErrors(['error' => 'error creating client']);
        }
    }

    public function edit(Client $client)

    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required',
        ]);

        $client->update($validatedData);

        return  redirect()->back()->with('success', 'Client updated successfully!');
    }

    public function destroy(Client $client)
    {
        $clientUserInfos = User::where('id',$client->userID)->first();

        $mailData = [
            'title' => 'Mail From Admin',   
            'firstName' => $client->firstName,
            'lastName' => $client->lastName,
            'username' => $clientUserInfos->username
        ];
        

        Mail::to($clientUserInfos->email)->send(new RemoveMail($mailData));
        
        $client->delete();
        User::where('id',$client->userID)->delete();

        return redirect()->back()->with('success', 'Client deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        if ($query) {
            $clients = Client::where('firstName', 'like', '%' . $query . '%')
                ->orWhere('lastName', 'like', '%' . $query . '%')
                ->get();
        } else {
            $clients = Client::all();
        }
    
        return response()->json($clients);
    }

    public function clientRepairs(){

        $userID=auth()->user()->id;
        $client=Client::where('userID',$userID)->first();

         $repairs = Reparation::whereHas('vehicle', function ($query) use ($client) {
            $query->where('clientID', $client->id);
        })->with('vehicle.client')->get();

        $vehiclesInRepair = $repairs->map(function($repair) {
            return [
                'id' => $repair->id,
                'marke' => $repair->vehicle->marke,
                'model' => $repair->vehicle->model,
                'status' => $repair->status,
                'startDate' => $repair->startDate,
                'endDate' => $repair->endDate,
                'mechanicNotes' => $repair->mechanicNotes,
                'clientNotes' => $repair->clientNotes,

            ];
        });

        return view('clients.clientRepairs', compact('vehiclesInRepair'));
    } 

    public function updateClientComment(Request $request)
{
    $request->validate([
        'repair_id' => 'required|exists:repairs,id',
        'clientNotes' => 'required|string',
    ]);

    $repair = Reparation::find($request->repair_id);
    $repair->clientNotes = $request->clientNotes;
    $repair->save();

    return redirect()->back()->with('success', 'Your notes updated successfully.');
}

    public function export() 
    {
        return Excel::download(new ClientExport, 'clients.xlsx');
    }
    
    public function import() 
    {
        Excel::import(new ClientImport,request()->file('file'));
       
        return back();

    }
}
