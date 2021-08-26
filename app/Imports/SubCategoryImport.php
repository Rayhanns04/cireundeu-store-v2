<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubCategoryImport implements ToModel, WithHeadingRow
{
    private $categories;

    public function __construct()
    {
        $this->categories = Category::select('id', 'name')->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = $this->categories->where('name', $row['category'])->first();

        return new SubCategory([
            'id' => $row['id'],
            'name' => $row['name'],
            'category_id' => $category->id ?? NULL,
            'created_at' => $row['created_at']
        ]);
    }
}
