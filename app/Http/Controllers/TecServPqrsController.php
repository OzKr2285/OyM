<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TecServPqrs;


class TecServPqrsController extends Controller
{
    //
    public function detTecnicos(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;

        $det = TecServPqrs::join('personas','tec_serv_pqrs.id_tecnico','=','personas.id')
        ->select('personas.nombreFull as nombre','tec_serv_pqrs.id_servpqrs','tec_serv_pqrs.is_respo as Rol')
        ->where('tec_serv_pqrs.id_servpqrs',$buscar)
        ->orderBy('tec_serv_pqrs.is_respo', 'desc')->get();

        return ['detTec' =>$det];
    }
}
