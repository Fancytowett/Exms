<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable=['fname','lname','phone1','phone2'];

    public function students()
    {
        return $this->hasMany('App\Student');
    }


}
