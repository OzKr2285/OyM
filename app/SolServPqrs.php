<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolServPqrs extends Model
{
    //
    protected $table = 'sol_serv_pqrs';
    protected $fillable = ['id','id_servpqrs','solucion','fecha'];
    public $timestamps = false;
}
