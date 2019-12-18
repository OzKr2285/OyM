<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpTramite extends Model
{
    //
    protected $table = 'pqr_tp_tramite';
    protected $fillable = ['id','codigo','nombre'];
    public $timestamps = false;
}
