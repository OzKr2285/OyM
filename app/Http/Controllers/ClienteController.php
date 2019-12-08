<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Persona::join('mpios','personas.id_mpio','=','mpios.id') 
            -> join('cargos','personas.id_cargo','=','cargos.id') 
            -> join('areas','cargos.id_area','=','areas.id') 
            ->select('personas.id','nombres','apellidos','tp_doc','num_doc','areas.id as idArea','cargos.id as idcargo','cargos.nombre as nomcargo','genero','fec_nac','id_mpio','direccion','observacion',
            'telefono','email','is_empleado','nombreFull')
            ->where('personas.is_empleado','=',0)
            ->orderBy('personas.id', 'desc')->paginate(15);
        }
        else{
            $personas = Persona::join('mpios','personas.id_mpio','=','mpios.id')   
            ->where('nombreFull', 'like', '%'. $buscar . '%')
            ->orWhere('num_doc', 'like', '%'. $buscar . '%')
            ->orderBy('nombreFull', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }
    public function index2(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Persona::join('mpios','personas.id_mpio','=','mpios.id') 
            -> join('cargos','personas.id_cargo','=','cargos.id') 
            -> join('areas','cargos.id_area','=','areas.id') 
            ->select('personas.id','nombres','apellidos','tp_doc','num_doc','areas.id as idArea','cargos.id as idcargo','cargos.nombre as nomcargo','genero','fec_nac','id_mpio','direccion','observacion',
            'telefono','email','is_empleado','nombreFull')
            ->where('personas.is_empleado','=',1)
            ->orderBy('personas.id', 'desc')->paginate(15);
        }
        else{
            $personas = Persona::join('mpios','personas.id_mpio','=','mpios.id')   
            ->where('nombreFull', 'like', '%'. $buscar . '%')
            ->orWhere('num_doc', 'like', '%'. $buscar . '%')
            ->orderBy('nombreFull', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $persona = new Persona();
        $persona->id = $request->nui;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->tp_doc = $request->tp_doc;
        $persona->num_doc = $request->id;
        $persona->genero = $request->genero;
        $persona->id_mpio = $request->id_mpio;
        $persona->id_cargo = $request->id_cargo;
        $persona->direccion = $request->direccion;
        $persona->fec_nac = $request->fec_nac;
        $persona->observacion = $request->observacion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;

        $persona->save();
    }
    // store tecnico
    public function storeT(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = new Persona();
        $persona->id = $request->nui;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->tp_doc = $request->tp_doc;
        $persona->num_doc = $request->id;
        $persona->genero = $request->genero;
        $persona->id_mpio = $request->id_mpio;
        $persona->id_cargo = $request->id_cargo;
        $persona->direccion = $request->direccion;
        $persona->fec_nac = $request->fec_nac;
        $persona->observacion = $request->observacion;
        $persona->telefono = $request->telefono;
        $persona->is_empleado = $request->is_empleado;
        $persona->email = $request->email;
        
        $persona->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->id = $request->id;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->tp_doc = $request->tp_doc;
        $persona->num_doc = $request->id;
        $persona->genero = $request->genero;
        $persona->id_mpio = $request->id_mpio;
        $persona->id_cargo = $request->id_cargo;
        $persona->direccion = $request->direccion;
        $persona->fec_nac = $request->fec_nac;
        $persona->observacion = $request->observacion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        
        $persona->save();
    }
    public function selectCliente(Request $request){
        if (!$request->ajax()) return redirect('/');
    
        $filtro = $request->filtro;
        $clientes = Persona::where('nombre', 'like', '%'. $filtro . '%')
        ->orWhere('num_doc', 'like', '%'. $filtro . '%')
        ->select('id','nombre','num_doc')
        ->orderBy('nombre', 'asc')->get();
    
        return ['clientes' => $clientes];
    }
}
