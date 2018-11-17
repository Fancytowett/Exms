<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['phone','fname','mname','lname','year','class_id','stream_id'];

    public function guardian()
    {
        return $this->belongsTo('App\Guardian');
    }

    public function stream()
    {
        return $this->belongsTo('App\Stream');

}




}
