<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable=['subject_id','minrange','maxrange','grade'];

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function results()
    {
        return $this->hasMany('App\Result');
    }
}
