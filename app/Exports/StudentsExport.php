<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $class_id,$stream_id,$year;
    public function __construct( $class_id,$stream_id,$year)
    {
        $this->class_id=$class_id;
        $this->stream_id=$stream_id;
        $year->year=$year;
    }

    public function query()
    {
        return Student::query()
                 ->whereYear('created_at', $this->year);
    }
    
    public function headings(): array
    {
        return [
            '#',
            'Class',
            'Stream',
            'Year'
        ];
    }


    public function collection()
    {

        return $data2;
    }
}
