<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['adm_no','fname','mname','lname','year','class','stream_id'];

    public function guardian()
    {
        return $this->belongsTo('App\Guardian');
    }

    public function stream()
    {
        return $this->belongsTo('App\Stream');

}




}
