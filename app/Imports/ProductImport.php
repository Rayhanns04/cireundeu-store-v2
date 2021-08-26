<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    private $subcategories;

    public function __construct()
    {
        $this->subcategories = SubCategory::select('id', 'name', 'category_id')->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $subCategory = $this->subcategories->where('name', $row['sub_category_id'])->first();

        return new Product([
            'image' => $row['image'],
            'title' => $row['title'],
            'description' => $row['description'],
            'price' => $row['price'],
            'qty' => $row['qty'],
            'sub_category_id' => $subCategory->id ?? NULL,
            'created_at' => $row['created_at']
        ]);
    }
}
