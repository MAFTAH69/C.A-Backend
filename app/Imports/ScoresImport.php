<?php

namespace App\Imports;

use App\Score;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScoresImport implements ToModel, WithHeadingRow
{

    public function __construct($type, $id)
    {
        $this->type= $type;
        $this->id= $id;

    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        return new Score([
            'reg_number' => $row['registration_number'],
            'scored_marks' => $row['marks'],
            'scorable_type' => $this->type,
            'scorable_id' => $this->id

        ]);
    }
}
