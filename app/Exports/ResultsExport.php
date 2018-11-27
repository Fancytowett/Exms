<?php

namespace App\Exports;

use App\Result;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResultsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Result::all();
    }
}
