<?php

namespace App\Imports;

use App\Models\TypeOfPayment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TypeOfPaymentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TypeOfPayment([
            'id' => $row['id'],
            'name' => $row['name'],
            'created_at' => $row['created_at']
        ]);
    }
}
