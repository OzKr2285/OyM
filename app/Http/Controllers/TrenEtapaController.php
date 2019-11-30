<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrenEtapa;

class TrenEtapaController extends Controller
{
    //
    public function selectTrenEtapa(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
 
            $trenetapa = TrenEtapa::join('etapas','etapas.id','=','trenetapas.id_etapa')
            ->select('trenetapas.id','trenetapas.id_etapa','trenetapas.nombre')
            ->where('trenetapas.id_etapa',$buscar)
            ->orderBy('trenetapas.nombre', 'asc')->get();
  

      return ['trenetapa' => $trenetapa];
  }
}
