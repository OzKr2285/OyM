<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    //
    protected $table = 'etapas';
    protected $fillable = ['id','nombre','desc'];
    public $timestamps = false;

    public function trenEtapa(){
        return $this->hasMany('App\TrenEtapa');
    }
}
