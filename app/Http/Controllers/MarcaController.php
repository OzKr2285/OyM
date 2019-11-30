<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;

class MarcaController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $marca = Marca::orderBy('id', 'nombre')->paginate(15);
        }
        else{
            $marca = Marca::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $marca->total(),
                'current_page' => $marca->currentPage(),
                'per_page'     => $marca->perPage(),
                'last_page'    => $marca->lastPage(),
                'from'         => $marca->firstItem(),
                'to'           => $marca->lastItem(),
            ],
            'marca' => $marca
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marca = new Marca();
        $marca->nombre = $request->nombre;        
        $marca->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->id);
        $marca->nombre = $request->nombre;       
        $marca->save();
    }
    public function destroy(Request $request)
    {
        $marca = Marca::findOrFail($request->id);
        $marca->delete();
    
    }

    public function selectMarca(Request $request){
    if (!$request->ajax()) return redirect('/');
        $marca = Marca::select('id','nombre')->orderBy('nombre', 'asc')->get();
    return ['marca' => $marca];
  }
}
