<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.nombre as nomCat','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.edo' )
            ->orderBy('serv_pqrs.prioridad' , 'asc')->paginate(15);
        }
        else{
            $ticket  = TicketServ::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'descripcion')->paginate(15);
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
            $ticket->id_area = $request->id_area;
            $ticket->medio = $request->medio;
            $ticket->prioridad = $request->prioridad;
            $ticket->desc = $request->desc;
            $ticket->fecha = $mytime->toDateString();
           
            
            $ticket->save();

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
}
