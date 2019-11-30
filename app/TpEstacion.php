<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpEstacion extends Model
{
    //
    protected $fillable = ['nombre','descripcion'];
    
    public function Estaciones()
    {
        return $this->belongsTo('App\Estacion');
    }
}
