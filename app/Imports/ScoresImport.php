<?php

namespace App\Imports;

use App\Score;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScoresImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Score([
            'reg_number' => $row['reg_number'],
            'scored_marks' => $row['scored_marks'],
            'scorable_type' => $row['scorable_type'],
            'scorable_id' => $row['scorable_id'],
        ]);
    }
}
