<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetEquipo extends Model
{
    //
    protected $table = 'det_equipo';
    protected $fillable = ['id','id_equipo','id_accesorio','desc'];
    public $timestamps = false;


    public function Equipos(){
        return $this->belongsTo('App\Equipo');
    }   
    public function Accesorios(){
        return $this->belongsTo('App\Accesorio');
    }

}
