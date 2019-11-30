<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetMtoEs;


class DetMtoEsController extends Controller
{
    //
    public function equiposMto(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;        
        
        if ($buscar==''){
            $equipo = DetMtoEs::join('det_equipos_estacion','det_mto_es.id_equipo','=','det_equipos_estacion.id')
            ->join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->join('equipos','det_equipos_estacion.id_equipo','=','equipos.id') 
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')  
            ->join('modelos','equipos.id_modelo','=','modelos.id')           
            ->select('det_mto_es.id_mto','ref_equipos.nombre','det_equipos_estacion.tp_tren','det_equipos_estacion.id_etapa','etapas.nombre as nomEtapa','equipos.tag','equipos.serial','modelos.nombre as modelo')            
            ->orderBy('det_mto_es.id', 'asc')->get();
        }
        else{
            $equipo = DetMtoEs::join('det_equipos_estacion','det_mto_es.id_equipo','=','det_equipos_estacion.id')
            ->join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->join('equipos','det_equipos_estacion.id_equipo','=','equipos.id') 
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')    
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->select('det_mto_es.id_mto','ref_equipos.nombre','ref_equipos.id as idRefE','det_equipos_estacion.tp_tren','det_equipos_estacion.id_etapa','etapas.nombre as nomEtapa','equipos.tag','equipos.serial','modelos.nombre as modelo')            
            ->where('det_mto_es.id_mto',$buscar)            
            ->orderBy('etapas.nombre', 'asc')
            ->orderBy('det_equipos_estacion.tp_tren', 'asc')
            ->orderBy('det_mto_es.id', 'asc')->get();
            
        }
        
        return ['equipo' => $equipo];
    }
}
