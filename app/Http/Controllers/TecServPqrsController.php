<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TecServPqrs;


class TecServPqrsController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ticket = TecServPqrs::join('serv_pqrs','tec_serv_pqrs.id_servpqrs','=','serv_pqrs.id') 
            ->join('personas','serv_pqrs.id_usuario','=','personas.id')  
            ->join('personas as p','serv_pqrs.id_lider','=','p.id')  
            ->join('cargos','p.id_cargo','=','cargos.id')
            ->join('areas','cargos.id_area','=','areas.id')   
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('tec_serv_pqrs.id_tecnico','serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.nombres','personas.apellidos',
            'personas.email','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.id as idCat','categorias.nombre as nomCat',
            'objpqrs.id as idObjpqrs','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.medio','serv_pqrs.edo','areas.id as idArea',
            'areas.nombre as nomArea','p.id_cargo as idCargo','cargos.nombre as nomCargo','serv_pqrs.id_lider' )
            ->where('tec_serv_pqrs.id_tecnico',\Auth::user()->id)            
            ->orderBy('serv_pqrs.fecha' , 'desc')->orderBy('serv_pqrs.prioridad' , 'asc')->paginate(15);
        }
        else{
            $ticket = TecServPqrs::join('serv_pqrs','tec_serv_pqrs.id_servpqrs','=','serv_pqrs.id') 
            ->join('personas','serv_pqrs.id_usuario','=','personas.id')  
            ->join('personas as p','serv_pqrs.id_lider','=','p.id')  
            ->join('cargos','p.id_cargo','=','cargos.id')
            ->join('areas','cargos.id_area','=','areas.id')   
            ->join('mpios','personas.id_mpio','=','mpios.id')
            ->join('objpqrs','serv_pqrs.id_objpqrs','=','objpqrs.id')
            ->join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('tec_serv_pqrs.id_tecnico','serv_pqrs.id as idticket','serv_pqrs.fecha','personas.id','personas.nombreFull','personas.nombres','personas.apellidos',
            'personas.email','personas.direccion','mpios.nombre as mpio','personas.telefono', 'categorias.id as idCat','categorias.nombre as nomCat',
            'objpqrs.id as idObjpqrs','objpqrs.nombre','serv_pqrs.desc','serv_pqrs.prioridad','serv_pqrs.medio','serv_pqrs.edo','areas.id as idArea',
            'areas.nombre as nomArea','p.id_cargo as idCargo','cargos.nombre as nomCargo','serv_pqrs.id_lider' )
            ->where('tec_serv_pqrs.id_tecnico',\Auth::user()->id)            
            ->whereBetween('serv_pqrs.fecha',[$buscar1,$buscar2])            
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
    public function detTecnicos(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;

        $det = TecServPqrs::join('personas','tec_serv_pqrs.id_tecnico','=','personas.id')
        ->select('personas.nombreFull as nombre','personas.email','tec_serv_pqrs.id_servpqrs','tec_serv_pqrs.is_respo as Rol')
        ->where('tec_serv_pqrs.id_servpqrs',$buscar)
        ->orderBy('tec_serv_pqrs.is_respo', 'desc')->get();

        return ['detTec' =>$det];
    }
}
