<?php

namespace App\Exports;

use App\Instructor;
use Maatwebsite\Excel\Concerns\FromCollection;

class InstructorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Instructor::all();
    }
}
