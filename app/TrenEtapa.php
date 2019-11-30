<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrenEtapa extends Model
{
    //
    protected $table = 'trenetapas';
    protected $fillable = ['id','id_etapa','nombre','desc'];

    public function Etapas()
    {
        return $this->belongsTo('App\Etapa');
    }
}
