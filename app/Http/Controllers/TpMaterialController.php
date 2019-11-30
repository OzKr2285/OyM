<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpMaterial;

class TpMaterialController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $tpmaterial = TpMaterial::orderBy('nombre')->paginate(15);
        }
        else{
            $tpmaterial = TpMaterial::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $tpmaterial->total(),
                'current_page' => $tpmaterial->currentPage(),
                'per_page'     => $tpmaterial->perPage(),
                'last_page'    => $tpmaterial->lastPage(),
                'from'         => $tpmaterial->firstItem(),
                'to'           => $tpmaterial->lastItem(),
            ],
            'tpmaterial' => $tpmaterial
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tpmaterial = new TpMaterial();
        $tpmaterial->nombre = $request->nombre;        
        $tpmaterial->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tpmaterial = TpMaterial::findOrFail($request->id);
        $tpmaterial->nombre = $request->nombre;        
        $tpmaterial->save();
    }
    public function destroy(Request $request)
    {
        $tpmaterial = TpMaterial::findOrFail($request->id);
        $tpmaterial->delete();
    
    }

    public function selectTpMaterial(Request $request){
          if (!$request->ajax()) return redirect('/');
        $tpmaterial = TpMaterial::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['tpmaterial' =>  $tpmaterial];
    }
}
