<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TecServPqrs extends Model
{
    //
    protected $table = 'tec_serv_pqrs';
    protected $fillable = ['id','id_servpqrs','id_tecnico','is_respo'];
    public $timestamps = false;

}
