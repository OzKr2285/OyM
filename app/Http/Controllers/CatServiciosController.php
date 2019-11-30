<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatServicios;

class CatServiciosController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $categorias = CatServicios::orderBy('id', 'desc')->paginate(15);
        }
        else{
            $categorias = CatServicios::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page'     => $categorias->perPage(),
                'last_page'    => $categorias->lastPage(),
                'from'         => $categorias->firstItem(),
                'to'           => $categorias->lastItem(),
            ],
            'categorias' => $categorias
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = new CatServicios();
        $categoria->nombre = $request->nombre;
        $categoria->desc = $request->descripcion;
        $categoria->save();
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = CatServicios::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->desc = $request->descripcion;
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = CatServicios::findOrFail($request->id);
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = CatServicios::findOrFail($request->id);
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function selectCategoria(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $categorias = CatServicios::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['categorias' => $categorias];
  }

}
