<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoController extends Controller
{
    //
    public function selectCargo(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
           
            $cargo = Cargo::join('areas','cargos.id_area','=','areas.id')
            ->select('cargos.id','cargos.nombre')
            ->where('cargos.id_area',$buscar)
            ->orderBy('cargos.nombre', 'asc')->get();

      return ['cargo' => $cargo];
  }
}
