<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DetEquipo;

class DetEquipoController extends Controller
{
    //

    
    public function index(Request $request)
    {
       if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
       if ($buscar==''){
            $detequipo = DetEquipo::join('accesorios','det_equipo.id_accesorio','=','accesorios.id')
            ->join('equipos','det_equipo.id_Equipo','=','equipos.id')            
            ->select('equipos.id','accesorios.serial','accesorios.nombre','accesorios.desc','accesorios.modelo')
            ->orderBy('accesorios.nombre', 'asc')->paginate(15);
        }
        else{
            $detequipo = DetEquipo::join('accesorios','det_equipo.id_accesorio','=','accesorios.id')
            ->join('equipos','det_equipo.id_Equipo','=','equipos.id')            
            ->select('det_equipo.id as idDet','accesorios.id','accesorios.serial','accesorios.nombre','accesorios.desc','accesorios.modelo')
            ->where('det_equipo.id_equipo',$buscar)
            ->orderBy('accesorios.nombre', 'asc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $detequipo->total(),
                'current_page' => $detequipo->currentPage(),
                'per_page'     => $detequipo->perPage(),
                'last_page'    => $detequipo->lastPage(),
                'from'         => $detequipo->firstItem(),
                'to'           => $detequipo->lastItem(),
            ],
            'detequipo' => $detequipo
        ];
    }

    
    public function destroy(Request $request)
    {
        $detequipo = DetEquipo::findOrFail($request->id);
        $detequipo->delete();
    
    }
}
