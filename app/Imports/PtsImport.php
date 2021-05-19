<?php

namespace App\Imports;

use App\Models\PTS;
use Maatwebsite\Excel\Concerns\ToModel;
use Orchid\Attachment\Attachable;
use Maatwebsite\Excel\Concerns\WithUpserts;
class PtsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PTS([
            'id' =>$row[0],
            'serial_pts'=>$row[1],
            'city'=>$row[2],
            'address'=>$row[3],
            'ip'=>$row[4],
            'info'=>$row[5],
            'created_at'=>$row[6],
            'updated_at'=>$row[7],
            'place'=>$row[8]
        ]);
    }
}
