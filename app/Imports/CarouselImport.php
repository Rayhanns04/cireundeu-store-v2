<?php

namespace App\Imports;

use App\Models\Carousel;
use Maatwebsite\Excel\Concerns\ToModel;

class CarouselImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Carousel([
           'image' => $row[1],
           'title' => $row[2],
           'created_at' => $row[3]
        ]);
    }
}
