<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicule;

class picture extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'picture',
        'vehicleID',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicule::class, 'vehicleID');
    }
}
