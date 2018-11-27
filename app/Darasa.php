<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Darasa extends Model
{
    protected $fillable=['name'];

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function student_subjects()
    {
     return $this->hasMany('App\Student_subject');
    }
}
