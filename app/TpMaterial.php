<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpMaterial extends Model
{
    //
    protected $table = 'tp_material';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
}
