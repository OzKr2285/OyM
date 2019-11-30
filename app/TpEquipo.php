<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpEquipo extends Model
{
    //
    protected $fillable = ['id','nombre','descripcion'];

    public $timestamps = false;
}
