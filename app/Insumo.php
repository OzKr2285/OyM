<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    //
    protected $table = 'insumos';
    protected $fillable = ['id','nombre','desc'];
    public $timestamps = false;

    public function detInsEquipo()
    {
        return $this->hasOne('App\DetInsEquipo');
    }
}
