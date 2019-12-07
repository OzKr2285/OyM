<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetCausal extends Model
{
    //
    protected $table = 'pqr_det_causal';
    protected $fillable = ['id','nombre','id_tp_tramite'];
    public $timestamps = false;
}
