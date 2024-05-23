<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanicien extends Model
{
    use HasFactory;

    protected $table = 'mecaniciens';
    protected $fillable = [
        'firstName',
        'lastName',
        'address',
        'phoneNumber',
        'salary',
        'rectuted_at',
        'userID'
    ];
    public function reparations()
    {
        return $this->hasMany(Reparation::class);
    }
}
