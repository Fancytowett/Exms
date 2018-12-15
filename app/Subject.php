<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=['name','short_name'];

    public function users()
    {
      return $this->hasMany('App\User');
   }

    public function resultuploads()
    {
        return $this->hasMany('App\ResultUpload');
   }


}


