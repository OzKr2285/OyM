<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefEquipo;

class RefEquipoController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $refe = RefEquipo::join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')
        ->select('ref_equipos.id','tp_equipos.nombre as nomE','ref_equipos.id_tpequipo','ref_equipos.nombre','ref_equipos.desc')
            ->orderBy('tp_equipos.nombre','asc','ref_equipos.nombre')->paginate(15);
        }
        else{
            $refe = RefEquipo::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'descripcion')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $refe->total(),
                'current_page' => $refe->currentPage(),
                'per_page'     => $refe->perPage(),
                'last_page'    => $refe->lastPage(),
                'from'         => $refe->firstItem(),
                'to'           => $refe->lastItem(),
            ],
            'refe' => $refe
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $refequipo = new RefEquipo();
         $refequipo->id_tpequipo = $request->idTpEquipo;
         $refequipo->nombre = $request->nombre;
         $refequipo->desc = $request->descripcion;
         $refequipo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $refequipo = RefEquipo::findOrFail($request->id);
         $refequipo->id_tpequipo = $request->idTpEquipo;
         $refequipo->nombre = $request->nombre;
         $refequipo->desc = $request->descripcion;
         $refequipo->save();
    }
    public function destroy(Request $request)
    {
         $refequipo = RefEquipo::findOrFail($request->id);
         $refequipo->delete();
    
    }
    public function selectRefEquipo(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;           
        $refequipo = RefEquipo::join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')
        ->select('ref_equipos.id','ref_equipos.nombre')
        ->where('ref_equipos.id_tpequipo',$buscar)
        ->orderBy('ref_equipos.nombre', 'asc')->get();

      return ['refequipo' => $refequipo];
  }
}
