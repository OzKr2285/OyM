<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefMaterial;

class RefMaterialController extends Controller

{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
        $refe = RefMaterial::join('tp_material','ref_materiales.id_tp_material','=','tp_material.id')
        ->select('ref_materiales.id','tp_material.nombre as nomE','ref_materiales.id_tp_material','ref_materiales.nombre','ref_materiales.cant','ref_materiales.und_med','ref_materiales.costo','ref_materiales.valor')
        ->orderBy('tp_material.nombre','asc','ref_material.nombre')->paginate(15);
        }
        else{
            $refe = RefMaterial::join('tp_material','ref_materiales.id_tp_material','=','tp_material.id')
            ->select('ref_materiales.id','tp_material.nombre as nomE','ref_materiales.id_tp_material','ref_materiales.nombre','ref_materiales.cant','ref_materiales.und_med','ref_materiales.costo','ref_materiales.valor')
            
            ->orderBy('tp_material.nombre','asc','ref_material.nombre')->paginate(15);
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
    public function getRefM(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar==''){
            $refm = RefMaterial::join('tp_material','ref_materiales.id_tp_material','=','tp_material.id')
            ->select('ref_materiales.id','tp_material.nombre as nomE','ref_materiales.id_tp_material','ref_materiales.nombre','ref_materiales.cant','ref_materiales.und_med','ref_materiales.costo','ref_materiales.valor')            
            ->orderBy('tp_material.nombre')->paginate(15);
            }
        else{
            $refm = RefMaterial::join('tp_material','ref_materiales.id_tp_material','=','tp_material.id')
            ->select('ref_materiales.id','tp_material.nombre as nomE','ref_materiales.id_tp_material','ref_materiales.nombre','ref_materiales.cant','ref_materiales.und_med','ref_materiales.costo','ref_materiales.valor')
            ->where('ref_materiales.id_tp_material', $buscar)
            ->where('ref_materiales.nombre', 'like', '%'. $criterio . '%')
            ->orderBy('tp_material.nombre')->paginate(15);
            }     
        return [
            'pagination' => [
                'total'        => $refm->total(),
                'current_page' => $refm->currentPage(),
                'per_page'     => $refm->perPage(),
                'last_page'    => $refm->lastPage(),
                'from'         => $refm->firstItem(),
                'to'           => $refm->lastItem(),
            ],
            'refM' => $refm
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $refequipo = new RefMaterial();
         $refequipo->id_tp_material = $request->idTpMaterial;
         $refequipo->nombre = $request->nombre;
         $refequipo->cant = $request->cantidad;
         $refequipo->und_med = $request->und_med;
         $refequipo->costo = $request->costo;
         $refequipo->valor = $request->valor;
         $refequipo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $refequipo = RefMaterial::findOrFail($request->id);
         $refequipo->id_tp_material = $request->idTpMaterial;
         $refequipo->nombre = $request->nombre;
         $refequipo->cant = $request->cantidad;
         $refequipo->und_med = $request->und_med;
         $refequipo->costo = $request->costo;
         $refequipo->valor = $request->valor;
         $refequipo->save();
    }
    public function destroy(Request $request)
    {
         $refequipo = RefMaterial::findOrFail($request->id);
         $refequipo->delete();
    
    }
    public function selectRefEquipo(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;           
        $refequipo = RefMaterial::join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')
        ->select('ref_equipos.id','ref_equipos.nombre')
        ->where('ref_equipos.id_tpequipo',$buscar)
        ->orderBy('ref_equipos.nombre', 'asc')->get();

      return ['refequipo' => $refequipo];
  }
}
