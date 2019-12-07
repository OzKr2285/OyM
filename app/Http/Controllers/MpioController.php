<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mpio;

class MpioController extends Controller
{
    //
    public function selectMpio(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;           
        $mpio = Mpio::join('dptos','mpios.id_dpto','=','dptos.id')
        ->select('mpios.id','mpios.nombre','dptos.nombre as nomDpto')
        // ->where('mpios.id_dpto',$buscar)
        ->orderBy('mpios.tmax', '>', 1)->orderBy('mpios.nombre', 'asc')->get();

      return ['mpio' => $mpio];
  }
  public function getMpios(Request $request)
  {
      // if (!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      $criterio = $request->criterio;

      $mpio = Mpio::join('dptos','mpios.id_dpto','=','dptos.id')
      ->select('dptos.nombre as nomDpto','mpios.id','mpios.nombre')
      ->where('mpios.id_dpto',$buscar)
      ->where('mpios.nombre', 'like', '%'. $criterio . '%')
      ->orderBy('mpios.tmax', '>', 1)->orderBy('mpios.nombre', 'asc')->paginate(10);

      return [
          'pagination' => [
              'total'        => $mpio->total(),
              'current_page' => $mpio->currentPage(),
              'per_page'     => $mpio->perPage(),
              'last_page'    => $mpio->lastPage(),
              'from'         => $mpio->firstItem(),
              'to'           => $mpio->lastItem(),
          ],
          'mpios' => $mpio
      ];
  }
}
