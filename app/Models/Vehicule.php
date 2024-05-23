<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\picture;

class Vehicule extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $fillable = ['marke', 'model', 'fuelType',  'registration', 'clientID'];

    public function client()
{
    return $this->belongsTo(Client::class,'clientID');
}

    public function reparations()
    {
        return $this->hasMany(Reparation::class,'vehicleID');
    }

    public function pictures()
    {
        return $this->hasMany(picture::class,'vehicleID');
    }

}
