<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Proveedor;
use App\Persona;


class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Proveedor::orderBy('proveedores.id', 'desc')->paginate(15);
        }
        else{
            $personas = Proveedor::where('proveedores.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('proveedores.id', 'desc')->paginate(15);
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

    public function selectProveedor(Request $request){
        if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;

        if ($filtro==''){
           
            $proveedores = Proveedor::select('id','nombre','contacto','direccion','telefono','email')
            ->where('nombre', 'like', '%'. $filtro . '%')
            ->orderBy('.nombre', 'asc')->get();
        }
        else{
            $proveedores = Proveedor::select('id','nombre','contacto','direccion','telefono','email')
            ->where('nombre', 'like', '%'. $filtro . '%')
            ->orWhere('id', 'like', '%'. $filtro . '%')
            ->orderBy('.nombre', 'asc')->get();
        }
    
  

        return ['proveedores' => $proveedores];



    }
    public function getProveedor(Request $request){
        //  if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
            $proveedores = Proveedor::select('id','nombre')
            ->orderBy('.nombre', 'asc')->get();
     
        return ['proveedores' => $proveedores];

    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->id = $request->num_doc;
            $persona->nombres = $request->nombre;
            $persona->tp_doc = $request->tp_doc;
            $persona->num_doc = $request->num_doc;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $proveedor = new Proveedor();
            $proveedor->nombre = $request->nombre;
            $proveedor->tp_doc = $request->tp_doc;
            $proveedor->id = $request->num_doc;
            $proveedor->num_doc = $request->num_doc;
            $proveedor->direccion = $request->direccion;
            $proveedor->telefono = $request->telefono;
            $persona->contacto = $request->contacto;
            $proveedor->email = $request->email;
            
            $proveedor->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();

            //Buscar primero el proveedor a modificar
            $proveedor = Proveedor::findOrFail($request->id);

            $persona = Persona::findOrFail($proveedor->id);

            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            
            $proveedor->contacto = $request->contacto;
            $proveedor->telefono_contacto = $request->telefono_contacto;
            $proveedor->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
}
