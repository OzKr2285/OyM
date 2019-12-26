<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\SolServPqrs;
use App\TicketServ;

class SolServPqrsController extends Controller
{
    //
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 


        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');

            $solucion = new SolServPqrs();
             // $solucion = SolServPqrs::findOrFail($request->id);
             $solucion->id_servpqrs = $request->id_servpqrs;        
             $solucion->solucion = $request->solucion;        
             $solucion->fecha = $mytime->toDateTimeString();      
             $solucion->id_tecnico = \Auth::user()->id;        
             $solucion->save();
         
             $ticket = TicketServ::findOrFail($request->id_servpqrs);
             $ticket->edo = $request->estado;  
             $ticket->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }


    }
}
