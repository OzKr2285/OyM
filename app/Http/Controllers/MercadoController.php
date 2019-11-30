<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mercado;

class MercadoController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mercado = Mercado::orderBy('nombre')->paginate(15);
        }
        else{
            $mercado = Mercado::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $mercado->total(),
                'current_page' => $mercado->currentPage(),
                'per_page'     => $mercado->perPage(),
                'last_page'    => $mercado->lastPage(),
                'from'         => $mercado->firstItem(),
                'to'           => $mercado->lastItem(),
            ],
            'mercado' => $mercado
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mercado = new Mercado();
        $mercado->nombre = $request->nombre;        
        $mercado->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mercado = Mercado::findOrFail($request->id);
        $mercado->nombre = $request->nombre;        
        $mercado->save();
    }
    public function destroy(Request $request)
    {
        $mercado = Mercado::findOrFail($request->id);
        $mercado->delete();
    
    }

    public function selectTpMercado(Request $request){
          if (!$request->ajax()) return redirect('/');
        $mercado = Mercado::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['mercado' =>  $mercado];
    }
}
