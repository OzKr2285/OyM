<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Accesorio;

class AccesorioController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $accesorio = Accesorio::orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $accesorio = Accesorio::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $accesorio->total(),
                'current_page' => $accesorio->currentPage(),
                'per_page'     => $accesorio->perPage(),
                'last_page'    => $accesorio->lastPage(),
                'from'         => $accesorio->firstItem(),
                'to'           => $accesorio->lastItem(),
            ],
            'accesorio' => $accesorio
        ];
    }

    public function listarAccesorio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
       if ($buscar==''){
            $accesorio = Accesorio::join('Equipos','accesorios.id_Equipo','=','equipos.id')
            ->select('accesorio.nombre','accesorio.desc','accesorio.modelo','accesorio.id_marca','accesorio.serial','accesorio.rg_temp','accesorio.rg_presion','accesorio.rg_flujo')
            ->orderBy('accesorio.nombre', 'asc')->paginate(15);
        }
        else{
            $accesorio = Accesorio::join('Equipos','accesorios.id_Equipo','=','equipos.id')
            ->select('accesorio.nombre','accesorio.desc','accesorio.modelo','accesorio.id_marca','accesorio.serial','accesorio.rg_temp','accesorio.rg_presion','accesorio.rg_flujo')
            ->where('accesorio.'.$criterio, 'like', '%'. $buscar . '%')
             ->orderBy('accesorio.nombre', 'asc')->paginate(15);
        }
        

        return ['accesorio' => $accesorio];
    }
 

 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $accesorio = new Accesorio();
        $accesorio->nombre = $request->nombre;
        $accesorio->desc = $request->descripcion;
        $accesorio->modelo = $request->modelo;
        
        $accesorio->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $accesorio = Accesorio::findOrFail($request->id);
        $accesorio->nombre = $request->nombre;
        $accesorio->desc = $request->descripcion;
        $accesorio->modelo = $request->modelo;
        
        $accesorio->save();
     
    }
    public function destroy(Request $request)
    {
        $accesorio = Accesorio::findOrFail($request->id);
        $accesorio->delete();
    
    }

}
