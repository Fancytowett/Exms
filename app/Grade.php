<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable=['subject_id','range','grade'];

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
