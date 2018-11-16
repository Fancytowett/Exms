<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['guardian_id','fname','mname','lname','year','class','stream_id'];

    public function guardian()
    {
        return $this->belongsTo('App\Guardian');
    }

    public function stream()
    {
        return $this->belongsTo('App\Stream');

}




}
