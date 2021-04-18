<?php

namespace App\Imports;

use App\Models\Census;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class CensusesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return  Census::updateOrCreate([
            'document'  => $row[3],
        ], [
            'name'      => $row[0],
            'last_name' => $row[1],
            'grade'     => $row[2],
            //'document'  => $row[3],
            'phone'     => $row[4],
            'code'      => substr(strtoupper(md5($row[3])), 0, 4),
            'users_id'   => Auth::user()->id,
        ]);
    }
}
