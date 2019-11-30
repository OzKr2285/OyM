<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    //
    protected $table = 'accesorios';
    protected $fillable = ['id','nombre','desc','modelo','serial'];
    public $timestamps = false;

    public function detEquipo()
    {
        return $this->hasOne('App\DetEquipo');
    }
  

}
