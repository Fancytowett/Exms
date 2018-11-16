<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_subject_class extends Model
{
    protected $fillable=['user_id','subject_id','stream','class'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject');

    }


}
