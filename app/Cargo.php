<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //
    protected $table = 'cargos';
    protected $fillable = ['id','id_area','nombre'];
    public $timestamps = false;
}
