<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetMercado extends Model
{
    //
    protected $table = 'det_mercados';
    protected $fillable = ['id','nombre','id_mercado','id_mpio'];
    public $timestamps = false;
}
