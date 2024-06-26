<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\picture;
use App\Models\Reparation;
use App\Models\Vehicule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VehiculeController extends Controller
{
    public function index()
    {
        $user=auth()->user();

        $client = Client::where('userID', $user->id)->first();

        $vehicles = Vehicule::join('pictures', 'vehicles.id', '=', 'pictures.vehicleID')->where('clientID',$client->id)

            ->get(["vehicles.*", "pictures.picture"]);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marke' => 'required',
            'model' => 'required',
            'fuelType' => 'required|string',
            'picture' => 'required|image',
            'registration' => 'required',
        ]);

        $user = Auth::user();

        $clients = Client::all();

        foreach ($clients as $client) {
            if ($user->id === $client->userID) {
                $clientID = $client->id;
            }
        }
        $vehicleData['marke'] = $request->marke;
        $vehicleData['model'] = $request->model;
        $vehicleData['fuelType'] = $request->fuelType;
        $vehicleData['registration'] = $request->registration;
        $vehicleData['clientID'] = $clientID;

        $vehicle = Vehicule::create($vehicleData);

        if ($vehicle) {
            $ext = request()->picture->getClientOriginalExtension();;
            $name = Str::random(30) . time() . "." . $ext;
            request()->picture->move(public_path("storage/avatars"), $name);
            $pictureData['picture'] = $name;
            $pictureData['vehicleID'] = $vehicle->id;

            $picture = picture::create($pictureData);

            if ($picture) {
                return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
            } else {
                return back()->withErrors(['message' => 'cannot add pic']);
            }
        } else {
            return back()->withErrors(['message' => 'cannot add vehicle']);
        }
    }

    public function edit(Vehicule $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicule $vehicle)
    {
        $validatedData = $request->validate([
            'marke' => 'required',
            'model' => 'required',
            'fuelType' => 'required',
            'registration' => 'required'
        ]);

        $vehicle->update($validatedData);

        return  redirect()->back()->with('success', 'vehicle updated successfully!');
    }

    public function destroy(Vehicule $vehicle)
    {
        picture::where('vehicleID', $vehicle->id)->delete();
        $vehicle->delete();
        return redirect()->back()->with('success', 'vehicle deleted successfully!');
    }

    public function search(): View
    {

        $vehicles = Vehicule::where('marke', 'like', '%' . request('search') . '%')
        ->orWhere('model', 'like', '%' . request('search') . '%')
        ->get();

        return view('vehicles.search',compact('vehicles'));
    }

    public function getVehiclesInRepair()
    {
        
        $repairs = Reparation::all()->with('vehicle.client')->get();

        $vehiclesInRepair = $repairs->map(function($repair) {
            return [
                'repair_id' => $repair->id,
                'vehicle_id' => $repair->vehicle->id,
                'vehicle_marke' => $repair->vehicle->marke,
                'vehicle_model' => $repair->vehicle->model,
                'client_id' => $repair->vehicle->client->id,
                'client_firstName' => $repair->vehicle->client->firstName,
                'client_lastName' => $repair->vehicle->client->lastName,
            ];
        });

        return view('adminHome.VehiclesInRepair',compact('vehiclesInRepair'));
    }
}
