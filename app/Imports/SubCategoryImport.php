<?php

namespace App\Imports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class SubCategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubCategory([
            'name' => $row[1],
            'category_id' => $row[2],
            'created_at' => $row[3]
        ]);
    }
}
