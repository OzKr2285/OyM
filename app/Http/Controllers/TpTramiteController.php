<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpTramite;
class TpTramiteController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $tptramite = TpTramite::orderBy('id', 'asc')->paginate(15);
        }
        else{
            $tptramite = TpTramite::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $tptramite->total(),
                'current_page' => $tptramite->currentPage(),
                'per_page'     => $tptramite->perPage(),
                'last_page'    => $tptramite->lastPage(),
                'from'         => $tptramite->firstItem(),
                'to'           => $tptramite->lastItem(),
            ],
            'datos' => $tptramite
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tptramite = new TpTramite();
        $tptramite->id = $request->codigo;
        $tptramite->nombre = $request->nombre;
        $tptramite->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tptramite = TpTramite::findOrFail($request->id);
        $tptramite->id = $request->codigo;
        $tptramite->nombre = $request->nombre;
        $tptramite->save();
    }
    public function destroy(Request $request)
    {
        $tptramite = TpTramite::findOrFail($request->id);
        $tptramite->delete();
    
    }
    //
    public function selectTpTramite(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $tptramite = TpTramite::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['tptramite' => $tptramite];
  }

}
