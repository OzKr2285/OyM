<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetEquipoEstacion;
use Illuminate\Support\Facades\DB;

class DetEquipoEstacionController extends Controller
{
    //
    public function indexEstacion(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $estacion = DetEquipoEstacion::join('estaciones','det_equipos_estacion.id_estacion','=','estaciones.id')
            ->join('tp_estacions','estaciones.idTpEstacion','=','tp_estacions.id')            
            ->join('mpios','estaciones.idmpio','=','mpios.id')            
            ->join('dptos','mpios.id_dpto','=','dptos.id')            
            ->select('tp_estacions.id as idtpes','tp_estacions.nombre as tpnombre','estaciones.id as idEs','estaciones.nombre','estaciones.descripcion','dptos.id as idDpto','estaciones.idmpio') 
            ->distinct()           
            ->orderBy('estaciones.nombre', 'asc')->paginate(15);
        //     $estacion = Equipo::join('proveedores','equipos.id_proveedor','proveedores.id')
        //     ->join('marcas','equipos.id_marca','marcas.id')
        //     ->join('personas','equipos.id_responsable','personas.id')
        //     ->select('equipos.serial','equipos.nombre as nomequipo','equipos.desc','equipos.modelo','proveedores.id','proveedores.nombre as nomprov', 'marcas.id','marcas.nombre as nommarca',
        //     'personas.id','personas.nombre as nomperso')
        //     ->orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $estacion = Equipo::where($criterio, 'like', '%'. $buscar . '%')
            ->Where('estado',0)            
            ->orderBy('nombre', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $estacion->total(),
                'current_page' => $estacion->currentPage(),
                'per_page'     => $estacion->perPage(),
                'last_page'    => $estacion->lastPage(),
                'from'         => $estacion->firstItem(),
                'to'           => $estacion->lastItem(),
            ],
            'estacion' => $estacion
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            // $equipo = new DetEquipoEstacion();
            // $equipo->id_estacion = $request->id_estacion;
            // $equipo->id_etapa = $request->id_etapa;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
      
            
            // $equipo->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $equipo = new DetEquipoEstacion();
                $equipo->id_equipo = $det['id'];        
                $equipo->id_estacion = $request->id_estacion;
                $equipo->id_etapa =$det['id_etapa'];         
                $equipo->tp_tren = $det['tp_tren'];
                $equipo->id_mpio = $request->id_mpio;             
                $equipo->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function indexExEstacion0(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $estacion = $request->estacion;
        
        if ($buscar==''){
            $equipo = DetEquipoEstacion::join('estaciones','det_equipos_estacion.id_estacion','=','estaciones.id')
            ->join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->join('equipos','det_equipos_estacion.id_equipo','=','equipos.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->select('ref_equipos.nombre')
            ->where('det_equipos_estacion.tp_Tren',0)  
            ->orderBy('ref_equipos.nombre', 'asc')->get();
        }
        else{
            $equipo = DetEquipoEstacion::join('estaciones','det_equipos_estacion.id_estacion','=','estaciones.id')
            ->join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->join('equipos','det_equipos_estacion.id_equipo','=','equipos.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')   
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->select('etapas.id','ref_equipos.nombre','ref_equipos.id as idref','equipos.id as idequipo','ref_equipos.desc','equipos.tag','equipos.serial','modelos.nombre as modelo','equipos.edo_mto')
            ->where('det_equipos_estacion.tp_Tren',0)
            ->where('det_equipos_estacion.id_etapa',$buscar)
            ->where('det_equipos_estacion.id_estacion',$estacion)
            ->orderBy('ref_equipos.nombre', 'asc')->get();
        }
        

        return ['equipo' => $equipo];
    }
    public function indexExEstacion1(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $estacion = $request->estacion;
        
        if ($buscar==''){
            $equipo = DetEquipoEstacion::join('estaciones','det_equipos_estacion.id_estacion','=','estaciones.id')
            ->join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->join('equipos','det_equipos_estacion.id_equipo','=','equipos.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')
            ->select('ref_equipos.nombre')
            ->where('det_equipos_estacion.tp_Tren',1)
            ->orwhere('det_equipos_estacion.id_estacion',18)
            ->orderBy('ref_equipos.nombre', 'asc')->get();
        //     $equipo = Equipo::join('proveedores','equipos.id_proveedor','proveedores.id')
        //     ->join('marcas','equipos.id_marca','marcas.id')
        //     ->join('personas','equipos.id_responsable','personas.id')
        //     ->select('equipos.serial','equipos.nombre as nomequipo','equipos.desc','equipos.modelo','proveedores.id','proveedores.nombre as nomprov', 'marcas.id','marcas.nombre as nommarca',
        //     'personas.id','personas.nombre as nomperso')
        //     ->orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $equipo = DetEquipoEstacion::join('estaciones','det_equipos_estacion.id_estacion','=','estaciones.id')
            ->join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->join('equipos','det_equipos_estacion.id_equipo','=','equipos.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')  
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->select('etapas.id','ref_equipos.nombre','equipos.id as idequipo','ref_equipos.desc','equipos.tag','equipos.serial','modelos.nombre as modelo','equipos.edo_mto')
            ->where('det_equipos_estacion.tp_Tren',1)
            ->where('det_equipos_estacion.id_estacion',$estacion)
            ->where('det_equipos_estacion.id_etapa',$buscar)
            ->orderBy('ref_equipos.nombre', 'asc')->get();
        }        

        return ['equipo' => $equipo];
    }
    public function indexEtapasEs(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $etapa = DetEquipoEstacion::join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->select('etapas.id','etapas.nombre', 'etapas.desc')
            ->where('det_equipos_estacion.tp_Tren',0)
            ->distinct() 
            ->orderBy('etapas.nombre', 'asc')->paginate(15);
        //     $equipo = Equipo::join('proveedores','equipos.id_proveedor','proveedores.id')
        //     ->join('marcas','equipos.id_marca','marcas.id')
        //     ->join('personas','equipos.id_responsable','personas.id')
        //     ->select('equipos.serial','equipos.nombre as nomequipo','equipos.desc','equipos.modelo','proveedores.id','proveedores.nombre as nomprov', 'marcas.id','marcas.nombre as nommarca',
        //     'personas.id','personas.nombre as nomperso')
        //     ->orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $etapa = DetEquipoEstacion::join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->select('etapas.id','etapas.nombre', 'etapas.desc')
            ->where('det_equipos_estacion.tp_Tren',0)
            ->where('det_equipos_estacion.id_estacion',$buscar)   
            ->distinct()          
            ->orderBy('etapas.nombre', 'asc')->get();
        }
        

        return ['etapa' => $etapa];
    }
    public function contE(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
     
        $etapa = DetEquipoEstacion::join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')        
        ->where('det_equipos_estacion.id_estacion',$buscar)->exists();          

        return ['etapa' => $etapa];
    }
}
