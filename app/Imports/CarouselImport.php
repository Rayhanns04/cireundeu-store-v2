<?php

namespace App\Imports;

use App\Models\Carousel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarouselImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Carousel([
            'image' => $row['image'],
            'title' => $row['title'],
            'created_at' => $row['created_at']
        ]);
    }
}
