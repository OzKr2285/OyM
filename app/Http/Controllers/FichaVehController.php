<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\FichaVeh;

class FichaVehController extends Controller
{
    //
    public function index(Request $request)
    {
    //    if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
       if ($buscar==''){
            $fichaveh = FichaVeh::join('personas','fichaveh.id_asignado','=','personas.id')
            ->join('lineas','fichaveh.id_linea','=','lineas.id')                       
            ->join('cargos','fichaveh.id_cargo','=','cargos.id')                       
            ->join('areas','cargos.id_area','=','areas.id')                       
            ->select('personas.nombreFull','personas.id as asignado','areas.id as area','cargos.id as cargo','fichaveh.id_linea as marca','fichaveh.id as placa','fichaveh.nchasis','fichaveh.fec_soat','fichaveh.fec_tecno','fichaveh.modelo','fichaveh.cilindraje','fichaveh.traccion','fichaveh.combustible','fichaveh.color','fichaveh.km','fichaveh.rin','fichaveh.nllantas','fichaveh.km_cambio','fichaveh.ref_aceite','fichaveh.fec_compra','fichaveh.desc','fichaveh.tipo','fichaveh.ref_aceite')
            ->orderBy('fichaveh.id', 'asc')->paginate(15);
        }
        else{
            $fichaveh = FichaVeh::join('personas','fichaveh.id_asignado','=','personas.id')            
            ->select('personas.nombreFull','fichaveh.id','fichaveh.fec_soat','fichaveh.fec_tecno','fichaveh.tipo','fichaveh.ref_aceite')           
            ->where('fichaveh.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('fichaveh.id', 'asc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $fichaveh->total(),
                'current_page' => $fichaveh->currentPage(),
                'per_page'     => $fichaveh->perPage(),
                'last_page'    => $fichaveh->lastPage(),
                'from'         => $fichaveh->firstItem(),
                'to'           => $fichaveh->lastItem(),
            ],
            'fichaveh' => $fichaveh
        ];
    }



    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $fichaveh = new FichaVeh();
            $fichaveh->id = $request->id;
            $fichaveh->nchasis = $request->nchasis;
            $fichaveh->fec_soat = $request->fec_soat;
            $fichaveh->fec_tecno = $request->fec_tecno;
            $fichaveh->id_asignado = $request->id_asignado;
            $fichaveh->id_linea = $request->id_linea;
            $fichaveh->tipo = $request->tipo;
            $fichaveh->id_linea = $request->id_linea;
            $fichaveh->modelo = $request->modelo;
            $fichaveh->cilindraje = $request->cilindraje;
            $fichaveh->traccion = $request->traccion;
            $fichaveh->combustible = $request->combustible;
            $fichaveh->color = $request->color;
            $fichaveh->km = $request->km;
            $fichaveh->rin = $request->rin;
            $fichaveh->nllantas = $request->nllantas;
            $fichaveh->km_cambio = $request->km_cambio;
            $fichaveh->ref_aceite = $request->ref_aceite;
            $fichaveh->fec_compra = $request->fec_compra;
            $fichaveh->desc = $request->desc;
            
            $fichaveh->save();

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
            // $detalle = DetEquipo::findOrFail($request->id);

            $fichaveh = FichaVeh::findOrFail($request->id);
            $fichaveh->id = $request->id;
            $fichaveh->nchasis = $request->nchasis;
            $fichaveh->fec_soat = $request->fec_soat;
            $fichaveh->fec_tecno = $request->fec_tecno;
            $fichaveh->id_asignado = $request->id_asignado;
            $fichaveh->id_linea = $request->id_linea;
            $fichaveh->tipo = $request->tipo;
            $fichaveh->id_linea = $request->id_linea;
            $fichaveh->modelo = $request->modelo;
            $fichaveh->cilindraje = $request->cilindraje;
            $fichaveh->traccion = $request->traccion;
            $fichaveh->combustible = $request->combustible;
            $fichaveh->color = $request->color;
            $fichaveh->km = $request->km;
            $fichaveh->rin = $request->rin;
            $fichaveh->nllantas = $request->nllantas;
            $fichaveh->km_cambio = $request->km_cambio;
            $fichaveh->ref_aceite = $request->ref_aceite;
            $fichaveh->fec_compra = $request->fec_compra;
            $fichaveh->desc = $request->desc;


            $fichaveh->save();
        
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
