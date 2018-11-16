<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['term','exam_id','class','stream','class_teacher','year'];

    public function exams()
    {
        return $this->hasMany('App\Exam');

}


}
