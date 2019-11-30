<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpEquipo;

class TpEquipoController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $tpequipo = TpEquipo::orderBy('nombre')->paginate(15);
        }
        else{
             $tpequipo = TpEquipo::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        =>  $tpequipo->total(),
                'current_page' =>  $tpequipo->currentPage(),
                'per_page'     =>  $tpequipo->perPage(),
                'last_page'    =>  $tpequipo->lastPage(),
                'from'         =>  $tpequipo->firstItem(),
                'to'           =>  $tpequipo->lastItem(),
            ],
            'tpequipo' =>  $tpequipo
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $tpequipo = new TpEquipo();
         $tpequipo->nombre = $request->nombre;
         $tpequipo->descripcion = $request->descripcion;
         $tpequipo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $tpequipo = TpEquipo::findOrFail($request->id);
         $tpequipo->nombre = $request->nombre;
         $tpequipo->descripcion = $request->descripcion;
         $tpequipo->save();
    }
    public function destroy(Request $request)
    {
         $tpequipo = TpEquipo::findOrFail($request->id);
         $tpequipo->delete();
    
    }

    public function selectTpEquipo(Request $request){
          if (!$request->ajax()) return redirect('/');
         $tpequipo = TpEquipo::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['tpequipo' =>  $tpequipo];
    }

}
