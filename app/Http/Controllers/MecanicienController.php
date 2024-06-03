<?php

namespace App\Http\Controllers;

use App\Exports\MecanicienExport;
use App\Mail\NotificationMail;
use App\Mail\RemoveMail;
use App\Models\Mecanicien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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

            $mailData = [
                'title' => 'Mail From Admin',   
                'username' => $request->username,
                'password' => $request->password
            ];

            Mail::to($request->email)->send(new NotificationMail($mailData));


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
        $mecanicienUserInfos = User::where('id',$mecanicien->userID)->first();

        $mailData = [
            'title' => 'Mail From Admin',   
            'firstName' => $mecanicien->firstName,
            'lastName' => $mecanicien->lastName,
            'username' => $mecanicienUserInfos->username
        ];
        

        Mail::to($mecanicienUserInfos->email)->send(new RemoveMail($mailData));
        $mecanicien->delete();
        User::where('id',$mecanicien->userID)->delete();

        return redirect()->back()->with('success', 'mecanicien deleted successfully!');
    }

    public function export() 
    {
        return Excel::download(new MecanicienExport, 'Mecaniciens.xlsx');
    }
}
