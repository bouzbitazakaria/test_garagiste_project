<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;

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
        
        $client->delete();
        User::where('id',$client->userID)->delete();

        return redirect()->back()->with('success', 'Client deleted successfully!');
    }
}
