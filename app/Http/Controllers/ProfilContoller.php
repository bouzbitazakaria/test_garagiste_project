<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilContoller extends Controller
{
    public function index()
    {
        $userID = auth()->user()->id;
        $client = Client::where('userID', $userID)->first();
        return view('clientHome.profil', compact('client'));
    }
    
    public function edit()
    {
        $userID = auth()->user()->id;
        $client = Client::where('userID', $userID)->first();
        return view('clientHome.profil', compact('client'));
    }
    

    public function update(Request $request, $id)
{

    $validatedData = $request->validate([
        'firstName' => 'required',
        'lastName' => 'required',
        'address' => 'required',
        'phoneNumber' => 'required',
    ]);

    $client = Client::find($id);

    if ($client) {
        $client->update($validatedData);

        return redirect()->back()->with('success', 'Profil updated successfully!');
    } else {
        return redirect()->back()->withErrors(['message' => 'Client not found']);
    }
}

    public function destroy(Client $client)
    {
        
        $client->delete();
        User::where('id',$client->userID)->delete();

        return redirect()->back()->with('success', 'Client deleted successfully!');
    }
}
