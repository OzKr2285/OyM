<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaRed extends Model
{
    //
    protected $table = 'fichared';
    protected $fillable = [
        'tp_red', 
        'id_diametro',
        'id_red',
        'id_mpio',
        'id_mpiofin',
        'fec_creacion',
        'cant_poli',
        'desc',
        'plano_g',
        'plano_a',
        'plano_c',
        'plano_p'        
    ];
    public $timestamps = false;
}
