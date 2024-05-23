<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $user=auth()->user();
        if($user){
            $role = $user->role;
        if($role==='admin'){
            return view('adminHome.index');
        }else if($role === 'client'){
            return view('clientHome.index');
        }else if($role === 'mecanicien'){
            return view('mecanicienHome.index');
        }
        }else{
            return view('auth.login');
        };
    }
}