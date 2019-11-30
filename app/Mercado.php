<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mercado extends Model
{
    //
    protected $table = 'mercados';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
}
