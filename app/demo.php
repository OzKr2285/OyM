<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class demo extends Model
{
    //
    protected $table = 'demo';
    protected $fillable = ['id','imagen'];
    public $timestamps = false;
}
