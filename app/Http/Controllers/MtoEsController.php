<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MtoEs;
use App\DetMtoEs;

class MtoEsController extends Controller
{
    //     
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mto = MtoEs::join('estaciones','mto_es.id_estacion','=','estaciones.id')           
            ->select('estaciones.id as idEstacion','estaciones.nombre','mto_es.id as idMto','mto_es.estado','mto_es.fec_realiza','mto_es.fec_finaliza','mto_es.tp_mto','mto_es.frec')
            ->distinct()                                   
            ->orderBy('estaciones.nombre', 'asc')
            ->orderBy('mto_es.estado', 'asc')->paginate(15);
        }
        else{
            $mto = MtoEs::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
            ->join('ref_equipos','det_act_equipo.id_equipo','=','ref_equipos.id')
            ->select('actividadese.id','det_act_equipo.id_equipo as idRefE','actividadese.nombre','actividadese.desc')
            ->distinct()
            ->where('det_act_equipo.id_equipo',$buscar)            
            ->orderBy('actividades.nombre', 'asc')
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $mto->total(),
                'current_page' => $mto->currentPage(),
                'per_page'     => $mto->perPage(),
                'last_page'    => $mto->lastPage(),
                'from'         => $mto->firstItem(),
                'to'           => $mto->lastItem(),
            ],
            'mto' => $mto
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
           
            $mto = new MtoEs();
           
            $mto->fec_realiza = $request->fec_realiza;         
            $mto->fec_finaliza = $request->fec_finaliza;         
            $mto->tp_mto = $request->tp_mto;         
            $mto->frec = $request->frec;         
            $mto->id_estacion = $request->id_estacion;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $mto->save();
            $detalles = $request->data;//Array de detalles
            // //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetMtoEs();
                $detalle->id_mto = $mto->id;
                $detalle->id_equipo =$det['id_equipo'];                                                                     
                $detalle->save();
            }          
            DB::commit();
            return ['idMto' => $mto->id];
        } catch (Exception $e){
            DB::rollBack();
        }      
    }
}
