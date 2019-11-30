<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etapa;

class EtapaController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $etapa = Etapa::orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $etapa = Etapa::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $etapa->total(),
                'current_page' => $etapa->currentPage(),
                'per_page'     => $etapa->perPage(),
                'last_page'    => $etapa->lastPage(),
                'from'         => $etapa->firstItem(),
                'to'           => $etapa->lastItem(),
            ],
            'etapa' => $etapa
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $etapa = new Etapa();
        $etapa->nombre = $request->nombre;
        $etapa->desc = $request->desc;

        $etapa->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $etapa = Etapa::findOrFail($request->id);
        if (!$request->ajax()) return redirect('/');
        $etapa->nombre = $request->nombre;
        $etapa->desc = $request->desc;

        $etapa->save();
    }

    public function destroy(Request $request)
    {
        $etapa = Etapa::findOrFail($request->id);
        $etapa->delete();
    
    }
    
    public function selectEtapa(Request $request){
        if (!$request->ajax()) return redirect('/');
        $etapa = Etapa::select('id','nombre','desc')->orderBy('nombre', 'asc')->get();
      return ['etapa' => $etapa];
  }
}
