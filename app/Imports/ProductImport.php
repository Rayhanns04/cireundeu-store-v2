<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'image' => $row[1],
            'title' => $row[2],
            'description' => $row[3],
            'price' => $row[4],
            'qty' => $row[5],
            'sub_category_id' => $row[6],
            'created_at' => $row[7]
        ]);
    }
}
