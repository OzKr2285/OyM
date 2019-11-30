<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    //
    protected $table = 'servicios';
    protected $fillable = ['id','id_catserv','nombre','desc'];
    public $timestamps = false;
}
