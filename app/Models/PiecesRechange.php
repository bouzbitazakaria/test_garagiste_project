<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiecesRechange extends Model
{
    use HasFactory;
    public $table = 'sparePart';
    
    protected $fillable = ['partName', 'partReference', 'supplier', 'price', 'stock'];
    public function factures()
{
    return $this->hasMany(Facture::class);
}
public function reparations()
{
    return $this->belongsToMany(Reparation::class)->withPivot('quantity');
}

}
