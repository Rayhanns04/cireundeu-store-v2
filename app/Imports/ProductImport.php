<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'image' => $row['image'],
            'title' => $row['title'],
            'description' => $row['description'],
            'price' => $row['price'],
            'qty' => $row['qty'],
            'sub_category_id' => $row['sub_category_id'],
            'created_at' => $row['created_at']
        ]);
    }
}
