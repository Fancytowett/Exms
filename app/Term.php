<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable=['name'];

    public function exams()
    {
       return $this->hasMany('App\Exam') ;
   }
}
