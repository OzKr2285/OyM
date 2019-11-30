<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaVeh extends Model
{
    //
    protected $table = 'marcaveh';
    protected $fillable = ['id','nombre'];

    public $timestamps = false;
}