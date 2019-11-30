<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    //
    protected $table = 'lineas';
    protected $fillable = ['id','nombre','id_marca'];

    public $timestamps = false;

}
