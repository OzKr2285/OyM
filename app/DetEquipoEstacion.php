<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetEquipoEstacion extends Model
{
    //
    protected $table = 'det_equipos_estacion';
    protected $fillable = ['id','id_estacion','id_etapa','id_equipo','tp_Tren'];
    public $timestamps = false;


    public function etapa()
    {
        return $this->hasOne('App\Etapa');
    }

    public function estacion()
    {
        return $this->hasOne('App\Estacion');
    }
    
    public function equipo()
    {
        return $this->hasOne('App\Equipo');
    }
}
