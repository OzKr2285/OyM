<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class AreaController extends Controller
{
    public function index(Request $request)
      {
        // if (!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      $criterio = $request->criterio;
      
      if ($buscar==''){
          $area = Area::orderBy('nombre')->paginate(15);
      }
      else{
          $area = Area::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre')->paginate(15);
      }

      return [
          'pagination' => [
              'total'        => $area->total(),
              'current_page' => $area->currentPage(),
              'per_page'     => $area->perPage(),
              'last_page'    => $area->lastPage(),
              'from'         => $area->firstItem(),
              'to'           => $area->lastItem(),
          ],
          'area' => $area
      ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $area = new Area();
        $area->nombre = $request->nombre;        
        $area->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $area = Area::findOrFail($request->id);
        $area->nombre = $request->nombre;        
        $area->save();
    }
    public function destroy(Request $request)
    {
        $area = Area::findOrFail($request->id);
        $area->delete();
    }
    //
    public function selectArea(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $area = Area::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['area' => $area];
  }
}
