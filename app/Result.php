<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable=['subject_id','score','set_name','student_id','user_id','term_id','exam_id'];

    public function exam()
    {
        return $this->belongsTo('App\Exam');

     }

    public function subject()
    {
        return $this->belongsTo('App\Subject');

     }

    public function user()
    {
        return $this->belongsTo('App\User');
     }

    public function term()
    {
        return $this->belongsTo('App\Term');
     }


}




