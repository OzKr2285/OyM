<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    //protected $primaryKey = 'id';
    protected $fillable = ['id','nombre','descripcion'];
    public $timestamps = false;

    public function articulos()
    {
        return $this->hasMany('App\ObjPQRS');
    }
}
