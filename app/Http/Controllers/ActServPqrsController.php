<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActServPqrs;

class ActServPqrsController extends Controller
{
    //
    public function detAct(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detact = ActServPqrs::join('serv_pqrs','act_serv_pqrs.id_servpqrs','=','serv_pqrs.id')   
            ->join('servicios','act_serv_pqrs.id_serv','=','servicios.id')          
            ->select('act_serv_pqrs.id_servpqrs','act_serv_pqrs.id_serv','servicios.nombre','servicios.desc','act_serv_pqrs.edo','act_serv_pqrs.new')
            ->orderBy('act_serv_pqrs.id_servpqrs', 'asc')->paginate(15);
        }
        else{
            $detact = ActServPqrs::join('serv_pqrs','act_serv_pqrs.id_servpqrs','=','serv_pqrs.id')     
            ->join('servicios','act_serv_pqrs.id_serv','=','servicios.id')       
            ->select('act_serv_pqrs.id_servpqrs','act_serv_pqrs.id_serv','servicios.nombre','servicios.desc','act_serv_pqrs.edo','act_serv_pqrs.new')                                 
            ->where('act_serv_pqrs.id_servpqrs',$buscar)            
            ->orderBy('act_serv_pqrs.id_servpqrs', 'asc')->paginate(15);

        }
        
        return [
            'pagination' => [
                'total'        => $detact->total(),
                'current_page' => $detact->currentPage(),
                'per_page'     => $detact->perPage(),
                'last_page'    => $detact->lastPage(),
                'from'         => $detact->firstItem(),
                'to'           => $detact->lastItem(),
            ],
            'detact' => $detact
        ];
    }
}
