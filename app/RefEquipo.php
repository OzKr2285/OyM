<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefEquipo extends Model
{
    //
    protected $table = 'ref_equipos';
    protected $fillable = ['id','id_tpequipo','nombre','desc'];
    public $timestamps = false;

    public function refEquipos()
    {
        return $this->belongsTo('App\Equipo');
    }

}
