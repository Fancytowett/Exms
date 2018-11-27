<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['phone','fname','mname','lname','year','class_id','stream_id','adm_no'];

    public function darasa()
    {
        return $this->belongsTo('App\Darasa');
    }

    public function stream()
    {
        return $this->belongsTo('App\Stream');

}




}
