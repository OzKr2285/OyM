<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dpto extends Model
{
    //
    protected $table = 'dptos';
    protected $fillable = ['id','nombre','tmax'];
}
