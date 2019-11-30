<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    //
    protected $table = 'estaciones';
    protected $fillable = ['id','idtpestacion','nombre','descripcion'];

    public function tpEstacion(){
        return $this->belongsTo('App\TpEstacion');
    }
}
