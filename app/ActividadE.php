<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadE extends Model
{
    //
    protected $table = 'actividadese';
    protected $fillable = ['id','desc'];
    public $timestamps = false;
}
