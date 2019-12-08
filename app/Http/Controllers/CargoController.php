<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoController extends Controller
{
    //
    public function index(Request $request)
    {
    // if (!$request->ajax()) return redirect('/');
    // parametro Buscar que viene del componente vue
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $cargo = Cargo::join('areas','cargos.id_area','=','areas.id')
            ->select('cargos.id','areas.id as idArea','areas.nombre as nomArea','cargos.nombre')
            ->orderBy('nomArea', 'asc')->paginate(15);
        }
        else{
            // $cargo = Cargo::where($criterio, 'like', '%'. $buscar . '%')
            // ->orderBy('nombre')->paginate(15);

            $cargo = Cargo::join('areas','cargos.id_area','=','areas.id')
            ->select('cargos.id','areas.id as idArea','areas.nombre as nomArea','cargos.nombre')
            ->where('cargos.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('areas.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('areas.nombre', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $cargo->total(),
                'current_page' => $cargo->currentPage(),
                'per_page'     => $cargo->perPage(),
                'last_page'    => $cargo->lastPage(),
                'from'         => $cargo->firstItem(),
                'to'           => $cargo->lastItem(),
            ],
            'cargo' => $cargo
      ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cargo = new Cargo();
        $cargo->nombre = $request->nombre; 
        $cargo->id_area = $request->idArea;
        $cargo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cargo = Cargo::findOrFail($request->id);
        $cargo->nombre = $request->nombre;
        $cargo->id_area = $request->idArea;
        $cargo->save();
    }
    public function destroy(Request $request)
    {
        $cargo = Cargo::findOrFail($request->id);
        $cargo->delete();
    
    }
    public function selectCargo(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
           
        $cargo = Cargo::join('areas','cargos.id_area','=','areas.id')
        ->select('cargos.id','areas.id as idArea','areas.nombre as nomArea','cargos.nombre')
        ->where('cargos.id_area',$buscar)
        ->orwhere('nomArea',$buscar)
        ->orderBy('nomArea', 'asc')->get();

        return ['cargo' => $cargo];
  }
}
