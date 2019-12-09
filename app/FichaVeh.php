<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaVeh extends Model
{
    //
    protected $table = 'fichaveh';
    protected $fillable = [
        'id', 
        'nchasis',
        'fec_soat',
        'fec_tecno',
        'id_asignado',
        'id_cargo',
        'tipo',
        'id_linea',
        'modelo',
        'cilindraje',
        'traccion',
        'combustible',
        'color',
        'km',
        'rin',
        'nllantas',
        'km_cambio',
        'ref_aceite',
        'fec_compra',
        'desc'
     ];
     public function noVeh()
     {
         return $this->hasOne('App\NoVeh');
     }
     public $timestamps = false;
}
