<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    //
    protected $table = 'equipos';
    protected $fillable = ['id','id_proveedor','id_responsable','id_refequipo','tag','desc','id_modelo','num_fac','serial','fec_compra','fec_garantia','fec_instala','link','datachip','estado','edo_mto','is_equipo'];
    public $timestamps = false;


    public function detEquipo()
    {
        return $this->hasOne('App\DetEquipo');
    }
  
    public function refEquipos()
    {
        return $this->hasOne('App\RefEquipo');
    }
}
