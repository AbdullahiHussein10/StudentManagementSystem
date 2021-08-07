<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
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

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getStudent()
    {
        return Grade::with('student');
    }
}
