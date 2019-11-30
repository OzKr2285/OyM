<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpEstacion;

class TpEstacionController extends Controller
{
    //

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $tpestacion = TpEstacion::orderBy('id', 'descripcion')->paginate(15);
        }
        else{
            $tpestacion = TpEstacion::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'descripcion')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $tpestacion->total(),
                'current_page' => $tpestacion->currentPage(),
                'per_page'     => $tpestacion->perPage(),
                'last_page'    => $tpestacion->lastPage(),
                'from'         => $tpestacion->firstItem(),
                'to'           => $tpestacion->lastItem(),
            ],
            'tpestacion' => $tpestacion
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tpestacion = new TpEstacion();
        $tpestacion->nombre = $request->nombre;
        $tpestacion->descripcion = $request->descripcion;
        $tpestacion->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tpestacion = TpEstacion::findOrFail($request->id);
        $tpestacion->nombre = $request->nombre;
        $tpestacion->descripcion = $request->descripcion;
        $tpestacion->save();
    }
    public function destroy(Request $request)
    {
        $tpestacion = TpEstacion::findOrFail($request->id);
        $tpestacion->delete();
    
    }

    public function selectTpEstacion(Request $request){
          if (!$request->ajax()) return redirect('/');
        $tpestacion = TpEstacion::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['tpestacion' => $tpestacion];
    }

}
