<?php

namespace App\Imports;

use App\Pasien;
use Maatwebsite\Excel\Concerns\ToModel;

class PasienImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

    }
}
