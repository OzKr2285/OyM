<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estacion;

class EstacionController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $estacion = Estacion::join('tp_estacions','estaciones.idtpestacion','=','tp_estacions.id')
        ->select('estaciones.id','estaciones.idtpestacion','estaciones.nombre','estaciones.descripcion','tp_estacions.nombre as tpnombre')
            ->orderBy('estaciones.idtpestacion', 'estaciones.nombre')->paginate(15);
        }
        else{
            $estacion = Estacion::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'descripcion')->paginate(15);
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
        $estacion = new Estacion();
        $estacion->idTpEstacion = $request->idTpEstacion;
        $estacion->nombre = $request->nombre;
        $estacion->descripcion = $request->descripcion;
        $estacion->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estacion = Estacion::findOrFail($request->id);
        $estacion->idtpestacion = $request->idTpEstacion;
        $estacion->nombre = $request->nombre;
        $estacion->descripcion = $request->descripcion;
        $estacion->save();
    }
    public function destroy(Request $request)
    {
        $estacion = Estacion::findOrFail($request->id);
        $estacion->delete();
    
    }
    public function selectEstacion(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;

        $estacion = Estacion::join('tp_estacions','tp_estacions.id','=','estaciones.idTpEstacion')
        ->select('estaciones.id','estaciones.nombre')
        ->where('estaciones.idTpEstacion',$buscar)
        ->orderBy('estaciones.nombre', 'asc')->get();
     

      return ['estacion' => $estacion];
  }
    public function selectNomEstacion(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;

        $estacion = Estacion::join('tp_estacions','tp_estacions.id','=','estaciones.idTpEstacion')
        ->select('estaciones.nombre')
        ->where('estaciones.id',$buscar)
        ->orderBy('estaciones.nombre', 'asc')->get();
     

      return ['estacion' => $estacion];
  }
 

}
