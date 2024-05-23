<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;
    protected $table= 'repairs';
    
    protected $fillable=[
        'description',
        'status',
        'startDate',
        'endDate',
        'mechanicNotes',
        'clientNotes',
        'mechanicID',
        'vehicleID'
    ];
    public function vehicle()
    {
        return $this->belongsTo(Vehicule::class, 'vehicleID');
    }

public function mecanicien()
{
    return $this->belongsTo(Mecanicien::class,'mechanicID');
}

}
