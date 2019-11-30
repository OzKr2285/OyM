<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    //
    protected $table = 'oficinas';
    protected $fillable = ['id','nombre','id_mpio'];
    public $timestamps = false;
}
