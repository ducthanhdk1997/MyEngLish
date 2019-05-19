<?php

namespace App\Imports;

use App\ResultTest;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportResultTest implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ResultTest([
            //
            'user_id' => $row[0],
            'score' => $row[1],
        ]);
    }
}
