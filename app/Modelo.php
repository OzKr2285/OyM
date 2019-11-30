<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    //
    protected $table = 'modelos';
    protected $fillable = ['id','nombre','id_marca'];

    public $timestamps = false;
}
