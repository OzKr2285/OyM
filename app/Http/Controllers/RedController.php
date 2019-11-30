<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Red;

class RedController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $red = Red::orderBy('id', 'nombre')->paginate(15);
        }
        else{
            $red = Red::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $red->total(),
                'current_page' => $red->currentPage(),
                'per_page'     => $red->perPage(),
                'last_page'    => $red->lastPage(),
                'from'         => $red->firstItem(),
                'to'           => $red->lastItem(),
            ],
            'red' => $red
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $red = new Red();
        $red->nombre = $request->nombre;
        $red->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $red = Red::findOrFail($request->id);
        $red->nombre = $request->nombre;
        $red->save();
    }
    public function destroy(Request $request)
    {
        $red = Red::findOrFail($request->id);
        $red->delete();
    
    }

    public function selectRed(Request $request){
        if (!$request->ajax()) return redirect('/');
        $red = Red::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['red' => $red];
  }
}
