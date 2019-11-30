<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diametro extends Model
{
    //
    protected $table = 'diametros';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
}