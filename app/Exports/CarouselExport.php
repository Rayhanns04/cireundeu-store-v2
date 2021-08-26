<?php

namespace App\Exports;

use App\Models\Carousel;
use Maatwebsite\Excel\Concerns\FromCollection;

class CarouselExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Carousel::all();
    }
}
