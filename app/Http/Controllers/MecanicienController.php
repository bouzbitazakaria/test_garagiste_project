<?php

namespace App\Http\Controllers;

use App\Models\Mecanicien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MecanicienController extends Controller
{
    public function index()
    {
        $mecaniciens = Mecanicien::all();
        return view('mecaniciens.index', compact('mecaniciens'));
    }

    public function create()
    {
        return view('mecaniciens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required',
            'salary'=> 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $userData['username'] = $request->username;
        $userData['email'] = $request->email;
        $userData['password'] = bcrypt($request->password); 
        $userData['role'] = 'mecanicien';

        $user = User::create($userData);
        if ($user) {
           
            $mecanicienData['firstName'] = $request->firstName;
            $mecanicienData['lastName'] = $request->lastName;
            $mecanicienData['address'] = $request->address;
            $mecanicienData['phoneNumber'] = $request->phoneNumber;
            $mecanicienData['salary'] = $request->salary;
            $mecanicienData['recruited_at'] =Carbon::now()->toDateString();
            $mecanicienData['userID'] = $user->id;

            $mecanicien = Mecanicien::create($mecanicienData);

            if ($mecanicien) {
                return redirect()->route('mecaniciens.index');
            }
        } else {
            redirect()->back()->withErrors(['error' => 'error creating mecanicien']);
        }
    }

    public function edit(Mecanicien $mecanicien)

    {
        return view('mecaniciens.edit', compact('mecanicien'));
    }

    public function update(Request $request, Mecanicien $mecanicien)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required',
            'salary'=> 'required',
        ]);

        $mecanicien->update($validatedData);

        return  redirect()->back()->with('success', 'mecanicien updated successfully!');
    }

    public function destroy(Mecanicien $mecanicien)
    {
        
        $mecanicien->delete();
        User::where('id',$mecanicien->userID)->delete();

        return redirect()->back()->with('success', 'mecanicien deleted successfully!');
    }
}
