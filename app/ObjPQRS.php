<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjPQRS extends Model
{
    //
    protected $table = 'objpqrs';
    protected $fillable = ['id','id_cat','nombre','desc'];
    public $timestamps = false;

    public function categorias(){
        return $this->belongsTo('App\Categorias');
    }
}
