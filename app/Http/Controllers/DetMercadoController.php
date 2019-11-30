<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetMercado;
use App\Mercado;
use Illuminate\Support\Facades\DB;

class DetMercadoController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
        $refe = DetMercado::join('mercados','det_mercados.id_mercado','=','mercados.id')     
        ->select('det_mercados.id_mercado','mercados.nombre as nomM')
        ->distinct('det_mercados.id_mercado')
        ->orderBy('mercados.nombre','asc','ref_material.nombre')->paginate(15);
        }
        else{
            $refe = DetMercado::join('mercados','det_mercados.id_mercado','=','mercados.id')  
            ->join('mpios','det_mercados.id_mpio','=','mpios.id')     
            ->join('dptos','mpios.id_dpto','=','dptos.id')     
            ->select('det_mercados.id','det_mercados.id_mercado','mercados.nombre as nomM','dptos.nombre as nomDpto','mpios.nombre')
            ->where('det_mercados.id_mercado',$buscar)
            ->orderBy('mercados.nombre','asc','ref_material.nombre')->paginate(15);
        }        
        return [
            'pagination' => [
                'total'        => $refe->total(),
                'current_page' => $refe->currentPage(),
                'per_page'     => $refe->perPage(),
                'last_page'    => $refe->lastPage(),
                'from'         => $refe->firstItem(),
                'to'           => $refe->lastItem(),
            ],
            'refe' => $refe
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            // $mercado = new DetMercado();
            $buscar = $request->idCiclo;
            // $equipo->id_ciclo = $request->id_ciclo;

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetMercado();
                $detalle->id_mercado = $buscar;
                $detalle->id_mpio = $det['id'];        
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

            // $mercado = new DetMercado();
            $buscar = $request->idCiclo;       
            // $equipo->id_ciclo = $request->id_ciclo;

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetMercado();
                $detalle->id_mercado = $buscar;
                $detalle->id_mpio = $det['id'];        
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
     
    public function destroy(Request $request)
    {
        $detequipo = DetMercado::findOrFail($request->id);
        $detequipo->delete();
    
    }
}
