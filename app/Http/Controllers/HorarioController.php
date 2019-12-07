<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;

class HorarioController extends Controller
{
    //
    public function index(Request $request)
    {
      // if (!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      $criterio = $request->criterio;
      
      if ($buscar==''){
          $horario = Horario::orderBy('desc')->paginate(15);
      }
      else{
          $horario = Horario::where($criterio, 'like', '%'. $buscar . '%')->orderBy('desc')->paginate(15);
      }

      return [
          'pagination' => [
              'total'        => $horario->total(),
              'current_page' => $horario->currentPage(),
              'per_page'     => $horario->perPage(),
              'last_page'    => $horario->lastPage(),
              'from'         => $horario->firstItem(),
              'to'           => $horario->lastItem(),
          ],
          'horario' => $horario
      ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = new Horario();
        $horario->desc = $request->desc;        
        $horario->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->desc = $request->desc;        
        $horario->save();
    }
    public function destroy(Request $request)
    {
        $horario = Horario::findOrFail($request->id);
        $horario->delete();
    }
    public function selectHorario(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $horario = Horario::select('id','desc')->orderBy('desc', 'asc')->get();
      return ['horario' => $horario];
  }
}
