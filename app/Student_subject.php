<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_subject extends Model
{
    protected $fillable=['student_id','subject_id','user_id','class_id'];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function subject()
    {
     return $this->belongsTo('App\Subject');

    }

    public function term()
    {
        return $this->belongsTo('App\Term');
     }

    public function darasa()
    {
     return $this->belongsTo('App\Darasa');
     }
}
