<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ObjPQRS;

class ObjPQRSController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ObjPQRS = ObjPQRS::join('categorias','objpqrs.id_cat','=','categorias.id')
        ->select('objpqrs.id','categorias.id as idcat','categorias.nombre as nomcat','objpqrs.nombre','objpqrs.desc')
            ->orderBy('objpqrs.id', 'objpqrs.nombre')->paginate(15);
        }
        else{
            $ObjPQRS = ObjPQRS::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $ObjPQRS->total(),
                'current_page' => $ObjPQRS->currentPage(),
                'per_page'     => $ObjPQRS->perPage(),
                'last_page'    => $ObjPQRS->lastPage(),
                'from'         => $ObjPQRS->firstItem(),
                'to'           => $ObjPQRS->lastItem(),
            ],
            'ObjPQRS' => $ObjPQRS
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ObjPQRS = new ObjPQRS();
        $ObjPQRS->id_cat = $request->idCategoria;
        $ObjPQRS->nombre = $request->nombre;
        $ObjPQRS->desc = $request->desc;
        $ObjPQRS->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ObjPQRS = ObjPQRS::findOrFail($request->id);
        $ObjPQRS->id_cat = $request->idCategoria;
        $ObjPQRS->nombre = $request->nombre;
        $ObjPQRS->desc = $request->desc;
        $ObjPQRS->save();
    }
    public function destroy(Request $request)
    {
        $ObjPQRS = ObjPQRS::findOrFail($request->id);
        $ObjPQRS->delete();
    
    }
    public function selectObjeto(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
           
             $ObjPQRS = ObjPQRS::join('categorias','objpqrs.id_cat','=','categorias.id')
            ->select('categorias.id','categorias.nombre as nomcat','objpqrs.id','objpqrs.nombre as nomobj')
            ->where('objpqrs.id_cat',$buscar)
            ->orderBy('objpqrs.nombre', 'asc')->get();

      return ['objeto' =>  $ObjPQRS];
  }
}
