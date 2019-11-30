<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Accesorio;
use Carbon\Carbon;
use App\Equipo;
use App\DetEquipo;

class EquipoController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $criterio2 = $request->criterio2;
        
        if ($buscar==''){
            // $equipo = Equipo::orderBy('id_refequipo', 'asc')->paginate(15);
            $equipo = Equipo::join('proveedores','equipos.id_proveedor','=','proveedores.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->join('personas','equipos.id_responsable','=','personas.id')
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')
            ->join('marcas','modelos.id_marca','=','marcas.id')
            ->select('equipos.id as ide','equipos.serial','equipos.num_fac','equipos.id_proveedor','proveedores.nombre as nomprov','ref_equipos.id','ref_equipos.nombre as nomref','modelos.nombre as modelo','modelos.id as idmodelo','equipos.id_responsable','personas.nombreFull as nomperso',
            'equipos.tag','equipos.fec_compra','equipos.fec_garantia','equipos.fec_instala','equipos.link','equipos.datachip','equipos.id_refequipo','equipos.desc',
            'equipos.datachip','tp_equipos.id as tpequipo','marcas.id as idmarca','equipos.edo_mto')
            ->where('equipos.is_equipo',0)
            ->orderBy('ref_equipos.nombre', 'asc')->paginate(15);
        }
        else{
            $equipo = Equipo::join('proveedores','equipos.id_proveedor','=','proveedores.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->join('personas','equipos.id_responsable','=','personas.id')
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')
            ->join('marcas','modelos.id_marca','=','marcas.id')
            ->select('equipos.id as ide','equipos.serial','equipos.num_fac','equipos.id_proveedor','proveedores.nombre as nomprov','ref_equipos.id','ref_equipos.nombre as nomref','modelos.nombre as modelo','modelos.id as idmodelo','equipos.id_responsable','personas.nombreFull as nomperso',
            'equipos.tag','equipos.fec_compra','equipos.fec_garantia','equipos.fec_instala','equipos.link','equipos.datachip','equipos.id_refequipo','equipos.desc',
            'equipos.datachip','tp_equipos.id as tpequipo','marcas.id as idmarca','equipos.edo_mto')
            ->where('equipos.is_equipo',0)
            ->orWhere('ref_equipos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orWhere('modelos.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('equipos.serial', 'like', '%'. $buscar . '%')
            ->orWhere('equipos.tag', 'like', '%'. $buscar . '%')->paginate(15);
       
        }
        

        return [
            'pagination' => [
                'total'        => $equipo->total(),
                'current_page' => $equipo->currentPage(),
                'per_page'     => $equipo->perPage(),
                'last_page'    => $equipo->lastPage(),
                'from'         => $equipo->firstItem(),
                'to'           => $equipo->lastItem(),
            ],
            'equipo' => $equipo
        ];
    }
    public function index2(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $criterio2 = $request->criterio2;
        
        if ($buscar==''){
            // $equipo = Equipo::orderBy('id_refequipo', 'asc')->paginate(15);
            $equipo = Equipo::join('proveedores','equipos.id_proveedor','=','proveedores.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->join('personas','equipos.id_responsable','=','personas.id')
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')
            ->join('marcas','modelos.id_marca','=','marcas.id')
            ->select('equipos.id as ide','equipos.is_equipo','equipos.serial','equipos.num_fac','equipos.id_proveedor','proveedores.nombre as nomprov','ref_equipos.id','ref_equipos.nombre as nomref','modelos.nombre as modelo','modelos.id as idmodelo','equipos.id_responsable','personas.nombreFull as nomperso',
            'equipos.tag','equipos.fec_compra','equipos.fec_garantia','equipos.fec_instala','equipos.link','equipos.datachip','equipos.id_refequipo','equipos.desc',
            'equipos.datachip','tp_equipos.id as tpequipo','marcas.id as idmarca','equipos.edo_mto')
            ->where('equipos.is_equipo',1)
            ->orderBy('ref_equipos.nombre', 'asc')->paginate(15);
        }
        else{
            $equipo = Equipo::join('proveedores','equipos.id_proveedor','=','proveedores.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->join('personas','equipos.id_responsable','=','personas.id')
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')
            ->join('marcas','modelos.id_marca','=','marcas.id')
            ->select('equipos.id as ide','equipos.serial','equipos.num_fac','equipos.id_proveedor','proveedores.nombre as nomprov','ref_equipos.id','ref_equipos.nombre as nomref','modelos.nombre as modelo','modelos.id as idmodelo','equipos.id_responsable','personas.nombreFull as nomperso',
            'equipos.tag','equipos.fec_compra','equipos.fec_garantia','equipos.fec_instala','equipos.link','equipos.datachip','equipos.id_refequipo','equipos.desc',
            'equipos.datachip','tp_equipos.id as tpequipo','marcas.id as idmarca','equipos.edo_mto')
            ->where('equipos.is_equipo',1)
            ->orWhere('ref_equipos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orWhere('modelos.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('equipos.serial', 'like', '%'. $buscar . '%')
            ->orWhere('equipos.tag', 'like', '%'. $buscar . '%')
            ->paginate(15);
       
        }
        

        return [
            'pagination' => [
                'total'        => $equipo->total(),
                'current_page' => $equipo->currentPage(),
                'per_page'     => $equipo->perPage(),
                'last_page'    => $equipo->lastPage(),
                'from'         => $equipo->firstItem(),
                'to'           => $equipo->lastItem(),
            ],
            'equipo' => $equipo
        ];
    }
    public function indexExEtapa(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $equipo = Equipo::join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')
            ->join('modelos','equipos.id_modelo','=','modelos.id')
            ->select('equipos.id','equipos.tag','ref_equipos.nombre as nomequipo','equipos.serial','modelos.nombre as modelo','equipos.desc','equipos.edo_mto')
            ->where('estado',0)
            ->orderBy('id_refequipo', 'asc')->paginate(15);
        //     $equipo = Equipo::join('proveedores','equipos.id_proveedor','proveedores.id')
        //     ->join('marcas','equipos.id_marca','marcas.id')
        //     ->join('personas','equipos.id_responsable','personas.id')
        //     ->select('equipos.serial','equipos.nombre as nomequipo','equipos.desc','equipos.modelo','proveedores.id','proveedores.nombre as nomprov', 'marcas.id','marcas.nombre as nommarca',
        //     'personas.id','personas.nombre as nomperso')
        //     ->orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $equipo = Equipo::where($criterio, 'like', '%'. $buscar . '%')
            ->Where('estado',0)            
            ->orderBy('nombre', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $equipo->total(),
                'current_page' => $equipo->currentPage(),
                'per_page'     => $equipo->perPage(),
                'last_page'    => $equipo->lastPage(),
                'from'         => $equipo->firstItem(),
                'to'           => $equipo->lastItem(),
            ],
            'equipo' => $equipo
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $equipo = new Equipo();
            $equipo->id_proveedor = $request->id_proveedor;
            $equipo->id_responsable = $request->id_responsable;
            $equipo->id_refequipo = $request->id_refequipo;
            $equipo->id_modelo = $request->id_modelo;
            $equipo->tag = $request->tag;
            $equipo->desc = $request->desc;
            $equipo->num_fac = $request->num_fac;
            $equipo->serial = $request->serial;
            $equipo->fec_compra = $request->fec_compra;
            $equipo->fec_garantia = $request->fec_garantia;
            $equipo->fec_instala = $request->fec_instala;
            $equipo->link = $request->link;
            $equipo->datachip = $request->datachip;
            
            $equipo->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetEquipo();
                $detalle->id_equipo = $equipo->id;
                $detalle->id_accesorio = $det['id'];        
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function storeComp(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $equipo = new Equipo();
            $equipo->id_proveedor = $request->id_proveedor;
            $equipo->id_responsable = $request->id_responsable;
            $equipo->id_refequipo = $request->id_refequipo;
            $equipo->id_modelo = $request->id_modelo;            
            $equipo->desc = $request->desc;
            $equipo->num_fac = $request->num_fac;
            $equipo->serial = $request->serial;
            $equipo->fec_compra = $request->fec_compra;
            $equipo->fec_garantia = $request->fec_garantia;
            $equipo->fec_instala = $request->fec_instala;
            $equipo->link = $request->link;
            $equipo->datachip = $request->datachip;
            $equipo->is_equipo = $request->isEquipo;
            
            $equipo->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetEquipo();
                $detalle->id_equipo = $equipo->id;
                $detalle->id_accesorio = $det['id'];        
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
            //  $detalle = DetEquipo::findOrFail($request->id);
            $equipo = Equipo::findOrFail($request->id);
           
            $equipo->id_proveedor = $request->id_proveedor;
            $equipo->id_responsable = $request->id_responsable;
            $equipo->id_refequipo = $request->id_refequipo;
            $equipo->id_modelo = $request->id_modelo;
            $equipo->tag = $request->tag;
            $equipo->desc = $request->desc;
            $equipo->num_fac = $request->num_fac;
            $equipo->serial = $request->serial;
            $equipo->fec_compra = $request->fec_compra;
            $equipo->fec_garantia = $request->fec_garantia;
            $equipo->fec_instala = $request->fec_instala;
            $equipo->link = $request->link;
            $equipo->datachip = $request->datachip;

            $equipo->save();
            $detalles = $request->data;//Array de detalles

            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetEquipo();
                $detalle->id_equipo = $equipo->id;
                $detalle->id_accesorio = $det['id'];        
                $detalle->save();
            }   

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function updateComp(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            //  $detalle = DetEquipo::findOrFail($request->id);
            $equipo = Equipo::findOrFail($request->id);
           
            $equipo->id_proveedor = $request->id_proveedor;
            $equipo->id_responsable = $request->id_responsable;
            $equipo->id_refequipo = $request->id_refequipo;
            $equipo->id_modelo = $request->id_modelo;            
            $equipo->desc = $request->desc;
            $equipo->num_fac = $request->num_fac;
            $equipo->serial = $request->serial;
            $equipo->fec_compra = $request->fec_compra;
            $equipo->fec_garantia = $request->fec_garantia;
            $equipo->fec_instala = $request->fec_instala;
            $equipo->link = $request->link;
            $equipo->datachip = $request->datachip;

            $equipo->save();
            $detalles = $request->data;//Array de detalles

            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetEquipo();
                $detalle->id_equipo = $equipo->id;
                $detalle->id_accesorio = $det['id'];        
                $detalle->save();
            }   

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function destroy(Request $request)
    {
        $equipo = Equipo::findOrFail($request->id);
        $equipo->delete();
    
    }
}
