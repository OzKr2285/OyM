<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActServPqrs extends Model
{
    //
    protected $table = 'act_serv_pqrs';
    protected $fillable = ['id','id_servpqrs','id_serv','edo','new'];
    public $timestamps = false;
}
