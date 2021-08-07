<?php

namespace App\Exports;

use App\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GradesExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function headings():array{
        return[
            'student_id',
            'student',
            'maths',
            'physics',
            'zoology',
            'botany',
            'chemistry',
            'engineering_cut_off',
            'medical_cut_off',
            'class',
            'final'
        ];
    }
    

    public function collection()
    {
        return Grade::with('student')->get();
    }

    public function map($grade) : array {
        return [
            $grade->student->id,
            $grade->student->name,
            $grade->maths,
            $grade->physics,
            $grade->zoology,
            $grade->botany,
            $grade->chemistry,
            $grade->engineering_cut_off,
            $grade->medical_cut_off,
            $grade->class,
            $grade->final,
        ] ;
    }
}
