<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable=['subject_id','score','student_id','class','adm_no','exam_id','term_id','year','grade','stream','user_id'];

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




