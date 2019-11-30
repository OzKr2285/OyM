<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketServ extends Model
{
    //
    protected $table = 'serv_pqrs';
    protected $fillable = ['id','id_usuario','id_objpqrs','id_area','medio','prioridad','desc','fecha','edo'];
    public $timestamps = false;
}
