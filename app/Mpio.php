<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpio extends Model
{
    //
    protected $table = 'mpios';
    protected $fillable = ['id','id_dpto','nombre','tmax'];

    public function Mpios()
    {
        return $this->belongsTo('App\FichaEs');
    }
}
