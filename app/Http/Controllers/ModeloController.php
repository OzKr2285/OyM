<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo;
use App\Marca;

class ModeloController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $modelo = Modelo::join('marcas','modelos.id_marca','=','marcas.id')
            ->select('modelos.id','modelos.nombre','marcas.id as idMarca','marcas.nombre as nommarca')
            ->orderBy('marcas.nombre','asc')->paginate(15);
        }
        else{
            $modelo = Modelo::join('marcas','modelos.id_marca','=','marcas.id')
            ->select('modelos.id','modelos.nombre','marcas.id as idMarca','marcas.nombre as nommarca')
            ->where('modelos.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('marcas.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('id', 'nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $modelo->total(),
                'current_page' => $modelo->currentPage(),
                'per_page'     => $modelo->perPage(),
                'last_page'    => $modelo->lastPage(),
                'from'         => $modelo->firstItem(),
                'to'           => $modelo->lastItem(),
            ],
            'datos' => $modelo
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $modelo = new Modelo();
        $modelo->id_marca = $request->idMarca;
        $modelo->nombre = $request->nombre;        
        $modelo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $modelo = Modelo::findOrFail($request->id);
        $modelo->id_marca = $request->idMarca;
        $modelo->nombre = $request->nombre;    
        $modelo->save();
    }
    public function destroy(Request $request)
    {
        $modelo = Modelo::findOrFail($request->id);
        $modelo->delete();
    
    }

    public function selectModelo(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;           
        $modelo = Modelo::join('marcas','modelos.id_marca','=','marcas.id')
        ->select('modelos.id','modelos.nombre')
        ->where('modelos.id_marca',$buscar)
        ->orderBy('modelos.nombre', 'asc')->get();

      return ['modelo' => $modelo];
  }
}
