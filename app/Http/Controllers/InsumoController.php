<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumo;

class InsumoController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $insumo = Insumo::orderBy('nombre', 'asc')->paginate(15);
        }
        else{
             $insumo = Insumo::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        =>  $insumo->total(),
                'current_page' =>  $insumo->currentPage(),
                'per_page'     =>  $insumo->perPage(),
                'last_page'    =>  $insumo->lastPage(),
                'from'         =>  $insumo->firstItem(),
                'to'           =>  $insumo->lastItem(),
            ],
            'insumo' =>  $insumo
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $insumo = new Insumo();
       $insumo->nombre = $request->nombre;
       $insumo->desc = $request->desc;
       $insumo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $insumo = Insumo::findOrFail($request->id);
       $insumo->nombre = $request->nombre;
       $insumo->desc = $request->desc;
       $insumo->save();
    }
    public function destroy(Request $request)
    {
       $insumo = Insumo::findOrFail($request->id);
       $insumo->delete();
    
    }

    public function selectInsumo(Request $request){
          if (!$request->ajax()) return redirect('/');
       $insumo = Insumo::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['insumo' => $insumo];
    }


}


