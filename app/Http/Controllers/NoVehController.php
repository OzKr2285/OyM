<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\NoVeh;

class NoVehController extends Controller
{
    //
    public function store(Request $request)
    {
        $mytime= Carbon::now('America/Lima');

        if (!$request->ajax()) return redirect('/');
        $novedad = new NoVeh();
        $novedad->id_placa = $request->id_placa;
        $novedad->id_novedad = $request->id_novedad;
        $novedad->fecha = $mytime->toDateString();
        $novedad->desc = $request->desc;
        $novedad->id_responsable = $request->id_responsable;
        $novedad->save();
    }


    public function index(Request $request)
    {
    //    if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;   
        
       if ($buscar==''){
            // $noveh = NoVeh::join('accesorios','det_equipo.id_accesorio','=','accesorios.id')
            // ->join('Equipos','det_equipo.id_Equipo','=','equipos.id')            
            // ->select('equipos.id','equipos.nombre as nomequipo','accesorios.serial','accesorios.nombre','accesorios.desc','accesorios.modelo')
            // ->orderBy('accesorios.nombre', 'asc')->paginate(15);
        }
        else{
            $noveh = NoVeh::join('novedades','nov_veh.id_novedad','=','novedades.id')  
            ->join('personas','nov_veh.id_responsable','=','personas.id')            
            ->select('personas.nombre as responsable','nov_veh.id_novedad','novedades.nombre','nov_veh.fecha','nov_veh.desc')
            ->where('nov_veh.id_placa',$buscar)
            ->orderBy('nov_veh.id', 'asc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $noveh->total(),
                'current_page' => $noveh->currentPage(),
                'per_page'     => $noveh->perPage(),
                'last_page'    => $noveh->lastPage(),
                'from'         => $noveh->firstItem(),
                'to'           => $noveh->lastItem(),
            ],
            'noveh' => $noveh
        ];
    }
}
