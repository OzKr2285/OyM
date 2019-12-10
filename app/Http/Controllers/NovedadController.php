<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novedad;

class NovedadController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $novedad = Novedad::orderBy('id', 'asc')->paginate(15);
        }
        else{
            $novedad  = Novedad::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $novedad ->total(),
                'current_page' => $novedad ->currentPage(),
                'per_page'     => $novedad ->perPage(),
                'last_page'    => $novedad ->lastPage(),
                'from'         => $novedad ->firstItem(),
                'to'           => $novedad ->lastItem(),
            ],
            'datos' => $novedad 
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $novedad  = new Novedad();
        $novedad ->nombre = $request->desc;
        $novedad ->desc = $request->nombre;
        $novedad ->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $novedad  = Novedad::findOrFail($request->id);
        $novedad ->nombre = $request->desc;
        $novedad ->desc = $request->nombre;
        $novedad ->save();
    }
    public function destroy(Request $request)
    {
        $novedad  = Novedad::findOrFail($request->id);
        $novedad ->delete();
    
    }
    public function selectNovedad(Request $request){
        if (!$request->ajax()) return redirect('/');
        $novedad = Novedad::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['novedad' => $novedad];
  }
}
