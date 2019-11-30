<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatServicios extends Model
{
    //
    protected $table = 'catservicios';    
    protected $fillable = ['id','nombre','desc'];
    public $timestamps = false;
}
