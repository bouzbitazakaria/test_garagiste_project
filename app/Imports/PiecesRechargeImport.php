<?php

namespace App\Imports;

use App\Models\PiecesRechange;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PiecesRechargeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PiecesRechange([
            'partName' =>$row['part_name'], 
            'partReference'=>$row['part_reference'], 
            'supplier' =>$row['supplier'], 
            'price' =>$row['price'], 
            'stock'=>$row['stock']
        ]);
    }
}
