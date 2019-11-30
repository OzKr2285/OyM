<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetActEquipo extends Model
{
    //
    protected $table = 'det_act_equipo';
    protected $fillable = ['id','id_act','id_equipo','id_actE','observacion'];
    public $timestamps = false;

    public function Act()
    {
        return $this->belongsTo('App\Actividad');
    }
    public function Equipo()
    {
        return $this->belongsTo('App\Equipo');
    }
}
