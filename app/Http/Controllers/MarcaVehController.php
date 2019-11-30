<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MarcaVeh;

class MarcaVehController extends Controller
{
    public function index(Request $request)
    {
      // if (!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      $criterio = $request->criterio;
      
        if ($buscar==''){
            $marcaVeh = MarcaVeh::orderBy('nombre')->paginate(15);
        }
        else{
            $marcaVeh = MarcaVeh::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $marcaVeh->total(),
                'current_page' => $marcaVeh->currentPage(),
                'per_page'     => $marcaVeh->perPage(),
                'last_page'    => $marcaVeh->lastPage(),
                'from'         => $marcaVeh->firstItem(),
                'to'           => $marcaVeh->lastItem(),
            ],
            'marcaVeh' => $marcaVeh
      ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marcaVeh = new MarcaVeh();
        $marcaVeh->nombre = $request->nombre;        
        $marcaVeh->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marcaVeh = MarcaVeh::findOrFail($request->id);
        $marcaVeh->nombre = $request->nombre;        
        $marcaVeh->save();
    }
    public function destroy(Request $request)
    {
        $marcaVeh = MarcaVeh::findOrFail($request->id);
        $marcaVeh->delete();
    
    }
    //
    public function selectMarca(Request $request){
        // if (!$request->ajax()) return redirect('/');
            $marcaVeh = MarcaVeh::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['marcaveh' => $marcaVeh];
      }
}
