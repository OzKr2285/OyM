<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActividadE;

class ActividadEController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $actividad = ActividadE::orderBy('desc', 'asc')->paginate(15);
        }
        else{
            $actividad = ActividadE::where($criterio, 'like', '%'. $buscar . '%')->orderBy('desc', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $actividad->total(),
                'current_page' => $actividad->currentPage(),
                'per_page'     => $actividad->perPage(),
                'last_page'    => $actividad->lastPage(),
                'from'         => $actividad->firstItem(),
                'to'           => $actividad->lastItem(),
            ],
            'actividade' => $actividad
        ];
    }
}
