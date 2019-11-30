<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MtoEs extends Model
{
    //
    protected $table = 'mto_es';
    protected $fillable = ['id','fec_realiza','fec_finaliza','tp_mto','frec','id_estacion','estado'];
    public $timestamps = false;

    public function detMtoEs()
    {
        return $this->hasOne('App\DetMtoEs');
    }
}
