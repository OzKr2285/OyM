<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ActividadE;
use App\DetActEquipo;

class DetActEquipoController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $actividad = DetActEquipo::join('actividadese','det_act_equipo.id_acte','=','actividadese.id')     
            ->join('ref_equipos','det_act_equipo.id_Equipo','=','ref_equipos.id')        
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')        
            ->select('det_act_equipo.id as idDet','tp_equipos.id as idTpE','actividadese.id','actividadese.desc','ref_equipos.nombre','det_act_equipo.id_Equipo')
            ->distinct()                                   
            ->orderBy('ref_equipos.nombre', 'asc')->paginate(15);
        }
        else{
            $actividad = DetActEquipo::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
            ->join('ref_equipos','det_act_equipo.id_equipo','=','ref_equipos.id')
            ->select('actividadese.id','det_act_equipo.id_equipo as idRefE','actividadese.nombre','actividadese.desc')
            ->distinct()
            ->where('det_act_equipo.id_equipo',$buscar)            
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $actividad->total(),
                'current_page' => $actividad->currentPage(),
                'per_page'     => $actividad->perPage(),
                'last_page'    => $actividad->lastPage(),
                'from'         => $actividad->firstItem(),
                'to'           => $actividad->lastItem(),
            ],
            'actividad' => $actividad
        ];
    }
    public function actE(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $actividad = DetActEquipo::join('actividades','det_act_equipo.id_act','=','actividades.id')     
            ->join('ref_equipos','det_act_equipo.id_Equipo','=','ref_equipos.id')        
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')        
            ->select('tp_equipos.id as idTpE','actividades.id','actividades.nombre','actividades.desc','ref_equipos.nombre','det_act_equipo.id_Equipo')
            ->distinct()   
            ->count('id_actE')                  
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        else{
            $actividad = DetActEquipo::join('actividades','det_act_equipo.id_act','=','actividades.id')   
            ->join('ref_equipos','det_act_equipo.id_Equipo','=','ref_equipos.id')        
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')        
            ->select('tp_equipos.id as idTpE','actividades.id','actividades.nombre','actividades.desc','ref_equipos.nombre','det_act_equipo.id_Equipo')                                 
            ->distinct()
            ->where('det_act_equipo.id_equipo',$buscar)            
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $actividad->total(),
                'current_page' => $actividad->currentPage(),
                'per_page'     => $actividad->perPage(),
                'last_page'    => $actividad->lastPage(),
                'from'         => $actividad->firstItem(),
                'to'           => $actividad->lastItem(),
            ],
            'actividad' => $actividad
        ];
    }

    public function detAct(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detact = DetActEquipo::join('actividades','det_act_equipo.id_act','=','actividades.id')           
            ->select('actividades.id','actividades.nombre','det_act_equipo.id','det_act_equipo.observacion')                                   
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        else{
            $detact = DetActEquipo::join('actividades','det_act_equipo.id_act','=','actividades.id')           
            ->select('det_act_equipo.id as idDet','actividades.id','actividades.nombre','det_act_equipo.id_act','det_act_equipo.id_equipo','det_act_equipo.observacion')            
            ->where('det_act_equipo.id_actE',$buscar)            
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $detact->total(),
                'current_page' => $detact->currentPage(),
                'per_page'     => $detact->perPage(),
                'last_page'    => $detact->lastPage(),
                'from'         => $detact->firstItem(),
                'to'           => $detact->lastItem(),
            ],
            'detact' => $detact
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
           
            $actividad = new ActividadE();
           
            $actividad->desc = $request->desc;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $actividad->save();
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetActEquipo();
                $detalle->id_actE = $actividad->id;
                $detalle->observacion = $det['observacion'];                        
                $detalle->id_equipo = $request->id_refequipo;
                $detalle->id_act =$det['id'];                                     
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            
            $actividad = new ActividadE();
            $actividad = ActividadE::findOrFail($request->id);  
            
            $actividad->desc = $request->descripcion;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $actividad->save();
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetActEquipo();
                $detalle = DetActEquipo::findOrFail($request->idDet);  
                $detalle->id_actE = $actividad->id;
                $detalle->observacion = $det['observacion'];                        
                $detalle->id_equipo = $request->idEquipo;
                $detalle->id_act =$det['id'];                                     
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
        // if (!$request->ajax()) return redirect('/');
        //  $insumo = new ActividadE();    
        //  $insumo = ActividadE::findOrFail($request->id);       
        //  $insumo->desc = $request->descripcion;
        //  $insumo->save();

        //  $detalles = $request->data;//Array de detalles

        //  foreach($detalles as $ep=>$det)
        //  {
        //      $insumoe = new DetActEquipo();   
        //      $insumoe->id_actE = $insumo->id;
        //      $insumoe->observacion = $det['observacion'];                        
        //      $insumoe->id_equipo = $request->idRefEquipo;
        //      $insumoe->id_act =$det['id'];                                     
        //      $insumoe->save();
        //  }    

    }
    public function destroy(Request $request)
    {
        $detequipo = ActividadE::findOrFail($request->id);
        $detequipo->delete();
    
    }
}
