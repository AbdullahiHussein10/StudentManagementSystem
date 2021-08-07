<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'roll_no'
    ];

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }
}
