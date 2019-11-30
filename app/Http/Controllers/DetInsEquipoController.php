<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\InsumoE;
use App\DetInsEquipo;

class DetInsEquipoController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detinsumo = DetInsEquipo::join('insumose','det_ins_equipo.id_insumoe','=','insumose.id')     
            ->join('ref_equipos','det_ins_equipo.id_refEquipo','=','ref_equipos.id')        
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')        
            ->select('det_ins_equipo.id as idDet','tp_equipos.id as idTpE','insumose.id','insumose.desc','ref_equipos.nombre','det_ins_equipo.id_refEquipo')
                                         
            ->orderBy('ref_equipos.nombre', 'asc')->paginate(15);
        }
        else{
            $detinsumo = DetInsEquipo::join('insumose','det_ins_equipo.id_insumoe','=','insumose.id')     
            ->join('ref_equipos','det_ins_equipo.id_refEquipo','=','ref_equipos.id')        
            ->select('det_ins_equipo.id as idDet','insumose.id','insumose.desc','ref_equipos.nombre') 
            ->distinct()                                  
            ->where('det_ins_equipo.id_insumoe',$buscar)            
            ->orderBy('ref_equipos.nombre', 'asc')->paginate(15);         

        }
        
        return [
            'pagination' => [
                'total'        => $detinsumo->total(),
                'current_page' => $detinsumo->currentPage(),
                'per_page'     => $detinsumo->perPage(),
                'last_page'    => $detinsumo->lastPage(),
                'from'         => $detinsumo->firstItem(),
                'to'           => $detinsumo->lastItem(),
            ],
            'detinsumo' => $detinsumo
        ];
    }
    public function detIns(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detinsumo = DetInsEquipo::join('insumos','det_ins_equipo.id_insumo','=','insumos.id')           
            ->select('insumos.id','insumos.nombre','det_ins_equipo.id','det_ins_equipo.id_refequipo','det_ins_equipo.observacion')                                               
            ->orderBy('insumos.nombre', 'asc')->paginate(15);
        }
        else{
            $detinsumo = DetInsEquipo::join('insumos','det_ins_equipo.id_insumo','=','insumos.id')           
            ->select('insumos.id','insumos.nombre','det_ins_equipo.id_insumoE','det_ins_equipo.id_refequipo','det_ins_equipo.observacion')            
            ->where('det_ins_equipo.id_InsumoE',$buscar)            
            ->orderBy('insumos.nombre', 'asc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $detinsumo->total(),
                'current_page' => $detinsumo->currentPage(),
                'per_page'     => $detinsumo->perPage(),
                'last_page'    => $detinsumo->lastPage(),
                'from'         => $detinsumo->firstItem(),
                'to'           => $detinsumo->lastItem(),
            ],
            'detinsumo' => $detinsumo
        ];
    }
    public function InsumosE(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detinsumo = DetInsEquipo::join('insumos','det_ins_equipo.id_insumo','=','insumos.id')  
            ->join('ref_equipos','det_ins_equipo.id_ref_equipo','=','ref_equipos.id')         
            ->select('insumos.id','insumos.nombre','det_ins_equipo.id','det_ins_equipo.id_refequipo','det_ins_equipo.observacion')                                               
            ->distinct('id_refequipo')
            ->orderBy('insumos.nombre', 'asc')->paginate(15);
        }
        else{
            $detinsumo = DetInsEquipo::join('insumos','det_ins_equipo.id_insumo','=','insumos.id')           
            ->select('insumos.id','insumos.nombre')            
            ->where('det_ins_equipo.id_refequipo',$buscar)   
            ->orderBy('insumos.nombre', 'asc')
            ->distinct('insumos.id')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $detinsumo->total(),
                'current_page' => $detinsumo->currentPage(),
                'per_page'     => $detinsumo->perPage(),
                'last_page'    => $detinsumo->lastPage(),
                'from'         => $detinsumo->firstItem(),
                'to'           => $detinsumo->lastItem(),
            ],
            'insumose' => $detinsumo
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
           
            $insumo = new InsumoE();
           
            $insumo->desc = $request->desc;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $insumo->save();
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetInsEquipo();
                $detalle->id_insumoE = $insumo->id;
                $detalle->observacion = $det['observacion'];                        
                $detalle->id_refequipo = $request->id_refequipo;
                $detalle->id_insumo =$det['id'];                                     
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
            
            $insumo = new InsumoE();
            $insumo = InsumoE::findOrFail($request->id);  
            
            $insumo->desc = $request->descripcion;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $insumo->save();
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetInsEquipo();
                $detalle = DetInsEquipo::findOrFail($request->idDet);  
                $detalle->id_insumoE = $insumo->id;
                $detalle->observacion = $det['observacion'];                        
                $detalle->id_refequipo = $request->idRefEquipo;
                $detalle->id_insumo =$det['id'];                                     
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }

        // if (!$request->ajax()) return redirect('/');
        //  $insumo = new InsumoE();    
        //  $insumo = InsumoE::findOrFail($request->id);       
        //  $insumo->desc = $request->descripcion;
        //  $insumo->save();

        //  $detalles = $request->data;//Array de detalles

        //  foreach($detalles as $ep=>$det)
        //  {
        //      $insumoe = new DetInsEquipo();   
        //      $insumoe->id_insumoE = $insumo->id;
        //      $insumoe->observacion = $det['observacion'];                        
        //      $insumoe->id_refequipo = $request->idRefEquipo;
        //      $insumoe->id_insumo =$det['id'];                                     
        //      $insumoe->save();
        //  }    

    }
    
}
