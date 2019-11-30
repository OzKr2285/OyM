<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diametro;

class DiametroController extends Controller
{
    //
    public function index(Request $request)
    {
      // if (!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      $criterio = $request->criterio;
      
      if ($buscar==''){
          $diametro = Diametro::orderBy('nombre')->paginate(15);
      }
      else{
          $diametro = Diametro::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre')->paginate(15);
      }

      return [
          'pagination' => [
              'total'        => $diametro->total(),
              'current_page' => $diametro->currentPage(),
              'per_page'     => $diametro->perPage(),
              'last_page'    => $diametro->lastPage(),
              'from'         => $diametro->firstItem(),
              'to'           => $diametro->lastItem(),
          ],
          'diametro' => $diametro
      ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $diametro = new Diametro();
        $diametro->nombre = $request->nombre;        
        $diametro->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $diametro = Diametro::findOrFail($request->id);
        $diametro->nombre = $request->nombre;        
        $diametro->save();
    }
    public function destroy(Request $request)
    {
        $diametro = Diametro::findOrFail($request->id);
        $diametro->delete();
    }
    public function selectDiametro(Request $request){
        if (!$request->ajax()) return redirect('/');
        $diametro = Diametro::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['diametro' => $diametro];
  }
}