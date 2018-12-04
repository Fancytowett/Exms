<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable=['name','class_id','term_id','year'];

    public function term()
    {
     return $this->belongsTo('App\Term');
    }

    public function class()
    {
     return $this->belongsTo('App\Darasa');
    }
}
