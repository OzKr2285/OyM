<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['id','nombres','apellidos','tp_doc','num_doc','id_cargo','genero','estrato','fec_nac','id_mpio','direccion','observacion','telefono','email','is_empleado','nombreFull','is_lider'];
    public $timestamps = false;

    public function provedor()
    {
        return $this->hasOne('App\Proveedor');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }


}
