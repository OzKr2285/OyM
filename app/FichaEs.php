<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEs extends Model
{
    //
    protected $table = 'ficha_estaciones';
    protected $fillable = [
        'id', 
        'nom_equipo',
        'desc',
        'id_mpio',
        'id_tren_etapa',
        'id_marca',
        'id_proveedor',
        'id_estacion',
        'fec_compra',
        'fec_garantia',
        'num_fac',
        'fec_instala',
        'modelo',
        'serial',
        'reg_temp',
        'reg_presion',
        'reg_flujo',
        'link',
        'tp_ficha'
     ];
     public function Mpio()
    {
        return $this->hasMany('App\Mpio');
    }
}
