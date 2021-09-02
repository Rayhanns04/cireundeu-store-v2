<?php

namespace App\Exports;

use App\Models\TypeOfPayment;
use Maatwebsite\Excel\Concerns\FromCollection;

class TypeOfPaymentExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TypeOfPayment::all();
    }
}
