<?php

namespace App\Exports;

use App\Models\Ninja;
use Maatwebsite\Excel\Concerns\FromCollection;

class NinjaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ninja::all();
    }
}
