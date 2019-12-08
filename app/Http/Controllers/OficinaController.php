<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;

class OficinaController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
                                    // nom tabla maestra -- tabla work        pk tabla maestra   
            $oficina = Oficina::join('horarios','oficinas.id_horario','=','horarios.id')
            ->join('mpios','oficinas.id_mpio','=','mpios.id')
            ->join('dptos','mpios.id_dpto','=','dptos.id')
            ->select('oficinas.id as idOficina','oficinas.nombre as nomOficina','oficinas.direccion as dirOficina','oficinas.telefono as telOficina','oficinas.email as emaOficina','horarios.id as idHorario','horarios.desc','mpios.id as idMpios','mpios.nombre as nomMpio','dptos.id as idDpto','dptos.nombre as nomDpto')
            ->orderBy('oficinas.nombre', 'asc')->paginate(15);
        }
        else{
            $oficina = Oficina::join('horarios','oficinas.id_horario','=','horarios.id')
            ->join('mpios','oficinas.id_mpio','=','mpios.id')
            ->join('dptos','mpios.id_dpto','=','dptos.id')
            ->select('oficinas.id as idOficina','oficinas.nombre as nomOficina','oficinas.direccion as dirOficina','oficinas.telefono as telOficina','oficinas.email as emaOficina','horarios.id as idHorario','horarios.desc','mpios.id as idMpios','mpios.nombre as nomMpio','dptos.id as idDpto','dptos.nombre as nomDpto')
            // ->orWhere('mpios.nombre', 'like', '%'. $buscar . '%')
            // ->orWhere('dptos.nombre', 'like', '%'. $buscar . '%')
            ->where('oficinas.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('mpios.id', 'like', '%'. $buscar . '%')
            ->orWhere('oficinas.direccion', 'like', '%'. $buscar . '%')
            ->orWhere('oficinas.telefono', 'like', '%'. $buscar . '%')
            ->orWhere('oficinas.email', 'like', '%'. $buscar . '%')
            ->orWhere('horarios.id', 'like', '%'. $buscar . '%')
            ->orderBy('oficinas.nombre', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $oficina->total(),
                'current_page' => $oficina->currentPage(),
                'per_page'     => $oficina->perPage(),
                'last_page'    => $oficina->lastPage(),
                'from'         => $oficina->firstItem(),
                'to'           => $oficina->lastItem(),
            ],
            'oficina' => $oficina
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficina = new Oficina();
        $oficina->nombre = $request->nombre;    
        $oficina->id_mpio = $request->idMpio;
        $oficina->direccion = $request->direccion;
        $oficina->telefono = $request->telefono;
        $oficina->email = $request->email;
        $oficina->id_horario = $request->idHorario;
        $oficina->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficina = Oficina::findOrFail($request->id);
        $oficina->nombre = $request->nombre;
        $oficina->id_mpio = $request->idMpio;
        $oficina->direccion = $request->direccion;
        $oficina->telefono = $request->telefono;
        $oficina->email = $request->email;
        $oficina->id_horario = $request->idHorario;
        
        $oficina->save();
    }
    public function destroy(Request $request)
    {
        $oficina = Oficina::findOrFail($request->id);
        $oficina->delete();
    
    }

    public function selectOficina(Request $request){
        //   if (!$request->ajax()) return redirect('/');
        $oficina = Oficina::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['oficina' =>  $oficina];
    }
}
