<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novedad;

class NovedadController extends Controller
{
    //
    public function selectNovedad(Request $request){
        if (!$request->ajax()) return redirect('/');
        $novedad = Novedad::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['novedad' => $novedad];
  }
}
