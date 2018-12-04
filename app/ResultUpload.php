<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultUpload extends Model
{
    protected $fillable=['subject_id','score','student_id','user_id','set_name','term_id','exam_id'];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function exam()
    {
     return $this->belongsTo('App\Exam');
    }

    public function term()
    {
        return $this->belongsTo('App\Term');

    }

//    public function getSubjectNameAttribute()
//    {
//        switch($this->subject){
//
//        }
//    }

}



