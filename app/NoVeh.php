<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoVeh extends Model
{
    //
    protected $table = 'nov_veh';
    protected $fillable = ['id_placa','id_novedad','fecha','desc','id_responsable'];
    public $timestamps = false;


    public function FichaVeh(){
        return $this->belongsTo('App\FichaVeh');
    }   
}
