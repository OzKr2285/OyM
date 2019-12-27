<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\MessageRecibido;
use App\TicketServ;
use App\TecServPqrs;
use App\ActServPqrs;

class TicketServController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')  
            ->join('personas as p','serv_pqrs.id_lider','=','p.id')  
            ->join('cargos','p.id_cargo','=','cargos.id')
            ->join('areas','cargos.id_area','=','areas.id')   
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.nombres','personas.apellidos',
            'personas.email','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.id as idCat','categorias.nombre as nomCat',
            'objpqrs.id as idObjpqrs','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.medio','serv_pqrs.edo','areas.id as idArea',
            'areas.nombre as nomArea','p.id_cargo as idCargo','cargos.nombre as nomCargo','serv_pqrs.id_lider' )
            ->orderBy('serv_pqrs.fecha' , 'desc')->orderBy('serv_pqrs.prioridad' , 'asc')->paginate(15);
        }
        else{
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')  
            ->join('personas as p','serv_pqrs.id_lider','=','p.id')  
            ->join('cargos','p.id_cargo','=','cargos.id')
            ->join('areas','cargos.id_area','=','areas.id')   
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.nombres','personas.apellidos',
            'personas.email','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.id as idCat','categorias.nombre as nomCat',
            'objpqrs.id as idObjpqrs','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.medio','serv_pqrs.edo','areas.id as idArea',
            'areas.nombre as nomArea','p.id_cargo as idCargo','cargos.nombre as nomCargo','serv_pqrs.id_lider' )
            ->where('serv_pqrs.id_lider',\Auth::user()->id)
            // ->orwhere('categorias.id',$buscar)
            ->orderBy('serv_pqrs.fecha' , 'desc')->orderBy('serv_pqrs.prioridad' , 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $ticket ->total(),
                'current_page' => $ticket ->currentPage(),
                'per_page'     => $ticket ->perPage(),
                'last_page'    => $ticket ->lastPage(),
                'from'         => $ticket ->firstItem(),
                'to'           => $ticket ->lastItem(),
            ],
            'ticket' => $ticket 
        ];
    }
    public function indexEstado(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')  
            ->join('personas as p','serv_pqrs.id_lider','=','p.id')  
            ->join('cargos','p.id_cargo','=','cargos.id')
            ->join('areas','cargos.id_area','=','areas.id')   
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.nombres','personas.apellidos',
            'personas.email','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.id as idCat','categorias.nombre as nomCat',
            'objpqrs.id as idObjpqrs','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.medio','serv_pqrs.edo','areas.id as idArea',
            'areas.nombre as nomArea','p.id_cargo as idCargo','cargos.nombre as nomCargo','serv_pqrs.id_lider' )
            ->where('serv_pqrs.edo',$buscar)
            ->orderBy('serv_pqrs.fecha' , 'desc')->orderBy('serv_pqrs.prioridad' , 'asc')->paginate(15);
        
 

        return [
            'pagination' => [
                'total'        => $ticket ->total(),
                'current_page' => $ticket ->currentPage(),
                'per_page'     => $ticket ->perPage(),
                'last_page'    => $ticket ->lastPage(),
                'from'         => $ticket ->firstItem(),
                'to'           => $ticket ->lastItem(),
            ],
            'ticket' => $ticket 
        ];
    }
    public function getDispo(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')     
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.nombre as nomCat','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.edo' )
            ->where('serv_pqrs.id_objpqrs', 7)
            ->orderBy('serv_pqrs.fecha', 'personas.nombre')->paginate(15);
        }
        else{
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')     
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.nombre as nomCat','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.edo' )
            ->where('serv_pqrs.id_objpqrs', 7)
            ->orderBy('serv_pqrs.fecha', 'personas.nombre')->paginate(15);
           
            
        }
        

        return [
            'pagination' => [
                'total'        => $ticket ->total(),
                'current_page' => $ticket ->currentPage(),
                'per_page'     => $ticket ->perPage(),
                'last_page'    => $ticket ->lastPage(),
                'from'         => $ticket ->firstItem(),
                'to'           => $ticket ->lastItem(),
            ],
            'ticket' => $ticket 
        ];
    }
    public function getDispoA(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')     
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.direccion','mpios.nombre as mpio','personas.telefono','categorias.nombre as nomCat', 'objpqrs.id as idObj','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.edo' )
            ->where('serv_pqrs.id_objpqrs', 7)
            ->where('serv_pqrs.edo', 3)
            ->orderBy('serv_pqrs.fecha', 'personas.nombre')->paginate(15);
        }
        else{
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')     
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.nombre as nomCat','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.edo' )
            ->where('serv_pqrs.id_objpqrs', 7)
            ->where('serv_pqrs.edo', 3)
            ->orderBy('serv_pqrs.fecha', 'personas.nombre')->paginate(15);
           
            
        }
        

        return [
            'pagination' => [
                'total'        => $ticket ->total(),
                'current_page' => $ticket ->currentPage(),
                'per_page'     => $ticket ->perPage(),
                'last_page'    => $ticket ->lastPage(),
                'from'         => $ticket ->firstItem(),
                'to'           => $ticket ->lastItem(),
            ],
            'ticket' => $ticket 
        ];
    }
    public function getDispoI(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')     
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.direccion','mpios.nombre as mpio','personas.telefono','categorias.nombre as nomCat', 'objpqrs.id as idObj','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.edo' )
            ->where('serv_pqrs.id_objpqrs', 9)
            ->orderBy('serv_pqrs.fecha', 'personas.nombre')->paginate(15);
        }
        else{
            $ticket = TicketServ::join('personas','serv_pqrs.id_usuario','=','personas.id')     
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.nombre as nomCat','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.edo' )
            ->where('serv_pqrs.id_objpqrs', 9)         
            ->orderBy('serv_pqrs.fecha', 'personas.nombre')->paginate(15);
           
            
        }
        

        return [
            'pagination' => [
                'total'        => $ticket ->total(),
                'current_page' => $ticket ->currentPage(),
                'per_page'     => $ticket ->perPage(),
                'last_page'    => $ticket ->lastPage(),
                'from'         => $ticket ->firstItem(),
                'to'           => $ticket ->lastItem(),
            ],
            'ticket' => $ticket 
        ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $ticket = new TicketServ();
            $ticket->id_usuario = $request->id_usuario;
            $ticket->id_objpqrs = $request->id_objpqrs;
            $ticket->id_lider = $request->id_lider;
            $ticket->medio = $request->medio;
            $ticket->prioridad = $request->prioridad;
            $ticket->desc = $request->desc;
            $ticket->fecha = $mytime->toDateTimeString();                       
            $ticket->save();
            $datosEmail = [
                "id" => $ticket->id,
                "email" => $request->email,
                "nombres" => $request->nombres,
                "apellidos" => $request->apellidos,
                "direccion" => $request->direccion,
                "telefono" => $request->telefono,
                "desc" => $request->desc,
                "nomTecnico" => $request->nomTecnico,
            ];
            // envi< dos parameros constructor
            // Mail::to($datosEmail['email'])->queue(new MessageRecibido($datosEmail));
            // Mail::to('soporteenercer@gmail.com')->send(new MessageRecibido($datosEmail));

            $detalles = $request->data;//Array de detalles Técnicos
            $detalles2 = $request->data2;//Array de detalles Actividades
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new TecServPqrs();
                $detalle->id_servpqrs = $ticket->id;
                $detalle->id_tecnico = $det['id'];        
                $detalle->save();
                
            }          
            foreach($detalles2 as $ep=>$det)
            {
                $detalle = new ActServPqrs();
                $detalle->id_servpqrs = $ticket->id;
                $detalle->id_serv = $det['id'];        
                $detalle->save();
            }          

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

            $ticket = TicketServ::findOrFail($request->id);
     
            // $ticket->id_usuario = $request->id_usuario;
            $ticket->id_objpqrs = $request->id_objpqrs;
            $ticket->prioridad = $request->prioridad;
            $ticket->desc = $request->desc;
            $ticket->edo = $request->estado;
   
            $ticket->save();

            $detalles = $request->data;//Array de detalles Técnicos
            $detalles2 = $request->data2;//Array de detalles Actividades
            //Recorro todos los elementos
            $datosEmail = [
                "id" => $ticket->id,
                "email" => $request->email,
                "nombres" => $request->nombres,
                "apellidos" => $request->apellidos,
                "direccion" => $request->direccion,
                "telefono" => $request->telefono,
                "desc" => $request->desc,                
            ];
            // Mail::to($datosEmail['email'])->queue(new MessageRecibido($datosEmail));
            foreach($detalles as $ep=>$det)
            {
                $detalle = new TecServPqrs();
                $detalle->id_servpqrs = $ticket->id;
                $detalle->id_tecnico = $det['id'];        
                $detalle->is_respo = $det['Rol'];        
                $detalle->save();
                Mail::to($det['email'])->queue(new MessageRecibido($datosEmail,$det));
            }          
            foreach($detalles2 as $ep=>$det)
            {
                $detalle = new ActServPqrs();
                $detalle->id_servpqrs = $ticket->id;
                $detalle->id_serv = $det['id'];        
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    

}
