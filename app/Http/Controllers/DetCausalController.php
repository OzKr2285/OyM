<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetCausal;

class DetCausalController extends Controller
{
    //

    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
             $detcausal = DetCausal::join('pqr_tp_tramite','pqr_det_causal.id_tp_tramite','=','pqr_tp_tramite.id')
        ->select('pqr_det_causal.id as idDet','pqr_det_causal.nombre','pqr_tp_tramite.id','pqr_tp_tramite.nombre as tpnombre')
            ->orderBy('pqr_det_causal.id', 'pqr_det_causal.nombre')->paginate(15);
        }
        else{
             $detcausal = DetCausal::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'descripcion')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        =>  $detcausal->total(),
                'current_page' =>  $detcausal->currentPage(),
                'per_page'     =>  $detcausal->perPage(),
                'last_page'    =>  $detcausal->lastPage(),
                'from'         =>  $detcausal->firstItem(),
                'to'           =>  $detcausal->lastItem(),
            ],
            'datos' =>  $detcausal
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $detcausal = new DetCausal();
         $detcausal->id = $request->id;
         $detcausal->id_tp_tramite = $request->idTpTramite;         
         $detcausal->nombre = $request->nombre;
         $detcausal->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $detcausal = DetCausal::findOrFail($request->id);
         $detcausal->id = $request->id;
         $detcausal->id_tp_tramite = $request->idTpTramite;
         $detcausal->nombre = $request->nombre; 
         $detcausal->save();
    }
    public function destroy(Request $request)
    {
         $detcausal = DetCausal::findOrFail($request->id);
         $detcausal->delete();
    
    }
    public function selectDetCausal(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
           
        $detcausal = DetCausal::join('pqr_tp_tramite','pqr_det_causal.id_tp_tramite','=','pqr_tp_tramite.id')
        ->select('pqr_det_causal.id','pqr_tp_tramite.id as idTpT','pqr_tp_tramite.nombre as nomTpT','pqr_det_causal.nombre')
        ->where('pqr_tp_tramite.id',$buscar)
        ->orderBy('nomTpT', 'asc')->get();

        return ['detcausal' => $detcausal];
  }

}
