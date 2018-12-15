<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overrallgrade extends Model
{
    protected $fillable= ['minrange','maxrange','grade'];
}
