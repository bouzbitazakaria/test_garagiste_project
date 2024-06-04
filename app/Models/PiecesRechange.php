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
public function repairs()
{
    return $this->belongsToMany(Reparation::class, 'repair_spare_part','spare_part_id')
                ->withPivot('quantity')
                ->withTimestamps();
}

}
