<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Linea;

class LineaController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $linea = Linea::join('marcaveh','lineas.id_marca','=','marcaveh.id')
            ->select('lineas.id','lineas.nombre','marcaveh.id as idMarca','marcaveh.nombre as nommarca')
            ->orderBy('lineas.nombre','asc')->paginate(15);
        }
        else{
          $linea = Linea::join('marcaveh','lineas.id_marca','=','marcaveh.id')
          ->select('lineas.id','lineas.nombre','marcaveh.id as idMarca','marcaveh.nombre as nommarca')
          ->where('lineas.nombre', 'like', '%'. $buscar . '%')
          ->orwhere('marcaveh.nombre', 'like', '%'. $buscar . '%')
          ->orderBy('lineas.nombre','asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $linea->total(),
                'current_page' => $linea->currentPage(),
                'per_page'     => $linea->perPage(),
                'last_page'    => $linea->lastPage(),
                'from'         => $linea->firstItem(),
                'to'           => $linea->lastItem(),
            ],
            'datos' => $linea
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $linea = new Linea();
        $linea->id_marca = $request->idMarca;
        $linea->nombre = $request->nombre;        
        $linea->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $linea = Linea::findOrFail($request->id);
        $linea->id_marca = $request->idMarca;
        $linea->nombre = $request->nombre;    
        $linea->save();
    }
    public function destroy(Request $request)
    {
        $linea = Linea::findOrFail($request->id);
        $linea->delete();
    
    }

    public function selectLinea(Request $request){
        $buscar = $request->buscar;
        if (!$request->ajax()) return redirect('/');
        $linea = Linea::join('marcaveh','lineas.id_marca','=','marcaveh.id')
        ->select('lineas.id','lineas.nombre')
        ->where('lineas.id_marca',$buscar)
        ->orderBy('lineas.nombre', 'asc')->get();
        
            
        return ['linea' => $linea];
      }
}
