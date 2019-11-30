<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dpto;

class DptoController extends Controller
{
    //

    public function selectDpto(Request $request){
        if (!$request->ajax()) return redirect('/');
        $dpto = Dpto::select('id','nombre')->orderBy('tmax', '>', 1)->orderBy('nombre', 'asc')->get();
      return ['dpto' => $dpto];
  }
    public function selectDptoCbx(Request $request){
        if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;

        if ($filtro==''){
           
            $dpto = Dpto::select('id','nombre')
            ->where('nombre', 'like', '%'. $filtro . '%')
            ->orderBy('.nombre', 'asc')->get();
        }
        else{
            $dpto = Dpto::select('id','nombre')
            ->where('nombre', 'like', '%'. $filtro . '%')
            ->orWhere('id', 'like', '%'. $filtro . '%')
            ->orderBy('.nombre', 'asc')->get();
        }

        return ['dpto' => $dpto];
  }

}
