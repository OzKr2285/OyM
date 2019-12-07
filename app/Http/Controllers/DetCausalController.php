<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetCausal;

class DetCausalController extends Controller
{
    //
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
