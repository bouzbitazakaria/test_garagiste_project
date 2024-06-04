<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PiecesRechange;
use App\Models\Reparation;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user) {
            $role = $user->role;
            if ($role === 'admin') {
                $clients = Client::all();
                return view('clients.index', compact('clients'));
            } else if ($role === 'client') {
                $user = auth()->user();

                $client = Client::where('userID', $user->id)->first();

                $vehicles = Vehicule::join('pictures', 'vehicles.id', '=', 'pictures.vehicleID')->where('clientID', $client->id)

                    ->get(["vehicles.*", "pictures.picture"]);
                return view('vehicles.index', compact('vehicles'));
            } else if ($role === 'mecanicien') {
                $reparations = Reparation::with('spareParts')->get();
                $spareParts = PiecesRechange::all();
                return view('reparations.index', compact('reparations', 'spareParts'));
            }
        } else {
            return view('auth.login');
        };
    }
}
