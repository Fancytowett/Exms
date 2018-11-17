<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable=['name'];

    public function tsc()
    {
        return $this->belongsTo('App\Teacher_subject_class');
    }
}
