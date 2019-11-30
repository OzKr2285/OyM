<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicios;

class ServicioController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $servicio = Servicios::join('catservicios','servicios.id_catserv','=','catservicios.id')
        ->select('servicios.id','catservicios.id as idcat','catservicios.nombre as nomser','servicios.nombre','servicios.desc')
            ->orderBy('servicios.id', 'servicios.nombre')->paginate(15);
        }
        else{
            $servicio = Servicios::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $servicio->total(),
                'current_page' => $servicio->currentPage(),
                'per_page'     => $servicio->perPage(),
                'last_page'    => $servicio->lastPage(),
                'from'         => $servicio->firstItem(),
                'to'           => $servicio->lastItem(),
            ],
            'servicio' => $servicio
        ];
    }
    public function getServicio(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
           
        $servicio = Servicios::join('catservicios','servicios.id_catserv','=','catservicios.id')
        ->select('servicios.id','servicios.nombre','servicios.desc')
        ->where('servicios.id_catserv', $buscar)
        ->orderBy('servicios.id', 'servicios.nombre')->paginate(15);

        return [
            'pagination' => [
                'total'        => $servicio->total(),
                'current_page' => $servicio->currentPage(),
                'per_page'     => $servicio->perPage(),
                'last_page'    => $servicio->lastPage(),
                'from'         => $servicio->firstItem(),
                'to'           => $servicio->lastItem(),
            ],
            'servicio' => $servicio
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $servicio = new Servicios();
       $servicio->id_catserv = $request->idCategoria;
       $servicio->nombre = $request->nombre;
       $servicio->desc = $request->desc;
       $servicio->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $servicio = Servicios::findOrFail($request->id);
       $servicio->id_catserv = $request->idCategoria;
       $servicio->nombre = $request->nombre;
       $servicio->desc = $request->desc;
       $servicio->save();
    }
    public function destroy(Request $request)
    {
       $servicio = Servicios::findOrFail($request->id);
       $servicio->delete();
    
    }
    public function selectObjeto(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
           
            $servicio = Servicios::join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('categorias.id','categorias.nombre as nomcat','objpqrs.id','objpqrs.nombre as nomobj')
            ->where('objpqrs.id_cat',$buscar)
            ->orderBy('objpqrs.nombre', 'asc')->get();

      return ['objeto' => $servicio];
  }
}
