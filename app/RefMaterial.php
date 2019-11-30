<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefMaterial extends Model
{
    //
    protected $table = 'ref_materiales';
    protected $fillable = ['id','id_tp_material','nombre','cant','und_med','costo','valor'];
    public $timestamps = false;
}
