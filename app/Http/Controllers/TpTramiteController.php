<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpTramite;
class TpTramiteController extends Controller
{
    //
    public function selectTpTramite(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $tptramite = TpTramite::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['tptramite' => $tptramite];
  }

}
