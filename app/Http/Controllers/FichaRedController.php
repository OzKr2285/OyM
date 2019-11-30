<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FichaRed;

class FichaRedController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $fichared = FichaRed::join('diametros','fichared.id_diametro','=','diametros.id')
            ->join('redes','fichared.id_red','=','redes.id')
            ->join('mpios','fichared.id_mpio','=','mpios.id')         
            ->join('mpios as mpiosfin','fichared.id_mpiofin','=','mpiosfin.id')         
            ->select('fichared.tp_red','fichared.id_diametro','diametros.nombre as nomdiam','fichared.id_red','redes.nombre as nomred',
            'fichared.id_mpio','mpios.nombre as mpioinicio','fichared.id_mpiofin','mpiosfin.nombre as mpiofin','fichared.fec_creacion','fichared.cant_poli','fichared.desc','fichared.plano_g','fichared.plano_a',
            'fichared.plano_c','fichared.plano_p')
            ->orderBy('fichared.tp_red', 'fichared.id_red')->paginate(15);
        }
        else{
            $fichared = FichaRed::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'descripcion')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $fichared->total(),
                'current_page' => $fichared->currentPage(),
                'per_page'     => $fichared->perPage(),
                'last_page'    => $fichared->lastPage(),
                'from'         => $fichared->firstItem(),
                'to'           => $fichared->lastItem(),
            ],
            'fichared' => $fichared
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fichared = new FichaRed();
        $fichared->tp_red = $request->tp_red;
        $fichared->id_diametro = $request->id_diametro;
        $fichared->id_red = $request->id_red;
        $fichared->id_mpio = $request->id_mpio;
        $fichared->id_mpiofin = $request->id_mpiofin;
        $fichared->fec_creacion = $request->fec_creacion;
        $fichared->cant_poli = $request->cant_poli;
        $fichared->desc = $request->desc;
        $fichared->plano_g = $request->plano_g;
        $fichared->plano_a = $request->plano_a;
        $fichared->plano_c = $request->plano_c;
        $fichared->plano_p = $request->plano_p;
        $fichared->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fichared = FichaRed::findOrFail($request->id);
        $fichared->id_diametro = $request->id_diametro;
        $fichared->id_red = $request->id_red;
        $fichared->id_mpio = $request->id_mpio;
        $fichared->fec_creacion = $request->fec_creacion;
        $fichared->cant_poli = $request->cant_poli;
        $fichared->desc = $request->desc;
        $fichared->plano_g = $request->plano_g;
        $fichared->plano_a = $request->plano_a;
        $fichared->plano_c = $request->plano_c;
        $fichared->plano_p = $request->plano_p;
        $fichared->save();
    }
    public function destroy(Request $request)
    {
        $fichared = FichaRed::findOrFail($request->id);
        $fichared->delete();
    
    }
    public function selectEstacion(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;

        $fichared = Estacion::join('tp_estacions','tp_estacions.id','=','estaciones.idTpEstacion')
        ->select('estaciones.id','estaciones.nombre')
        ->where('estaciones.idTpEstacion',$buscar)
        ->orderBy('estaciones.nombre', 'asc')->get();
     

      return ['estacion' => $fichared];
  }
}
