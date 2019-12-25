<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{
    //
    
    public function selectPersona(Request $request){
       if (!$request->ajax()) return redirect('/');
        $perso = Persona::select('personas.id','personas.nombreFull')
        ->where('personas.is_empleado','=',1)
        ->orderBy('nombreFull', 'asc')->get();
      return ['perso' => $perso];
  }
    public function selectLider(Request $request){
      //  if (!$request->ajax()) return redirect('/');
      $idArea = $request->buscar;

      $perso = Persona::join('cargos','personas.id_cargo','=','cargos.id')
      ->join('areas','cargos.id_area','=','areas.id')
      ->select('personas.id','personas.nombreFull','personas.id_cargo','cargos.nombre as nomCargo','areas.id as idArea','personas.email')
      ->where('personas.is_lider','=',1)
      ->where('areas.id','=',$idArea)
      ->orderBy('nombreFull', 'asc')->get();
    return ['perso' => $perso];
  }
    public function selectTecnico(Request $request){

      // if (!$request->ajax()) return redirect('/');

      $buscar = $request->buscar;
      
      if ($buscar==''){
        $perso = Persona::select('personas.id','personas.nombreFull','personas.email')
        ->where('personas.is_empleado','=',1)
        ->where('personas.id_cargo','=',25)
        ->orWhere('personas.id_cargo','=',26)
        ->orderBy('nombreFull', 'asc')->paginate(10);
      }
      else{
        $perso = Persona::select('personas.id','personas.nombreFull','personas.email')
        ->where('personas.is_empleado','=',1)
        ->where('personas.id_cargo','=',25)
        ->Where('personas.id_cargo','=',26)
        ->orWhere('personas.num_doc', 'like', '%'. $buscar . '%')  
        ->orWhere('personas.nombreFull', 'like', '%'. $buscar . '%')          
        ->orderBy('nombreFull', 'asc')->paginate(10);
      }
      
      return [
          'pagination' => [
              'total'        =>$perso->total(),
              'current_page' =>$perso->currentPage(),
              'per_page'     =>$perso->perPage(),
              'last_page'    =>$perso->lastPage(),
              'from'         =>$perso->firstItem(),
              'to'           =>$perso->lastItem(),
          ],
          'perso' =>$perso
      ];

  }
    public function getUsuario(Request $request){

      if (!$request->ajax()) return redirect('/');
      

      $buscar = $request->buscar;
      
      if ($buscar==''){
        $perso = Persona::select('personas.id','personas.nombreFull')
        ->where('personas.is_empleado','=',1)
        ->where('personas.id_cargo','=',25)
        ->orWhere('personas.id_cargo','=',26)
        ->orderBy('nombreFull', 'asc')->paginate(10);
      }
      else{
        $perso = Persona::select('personas.id','personas.num_doc','personas.nombres','personas.apellidos','personas.direccion','personas.telefono','personas.email','personas.nombreFull') 
        ->orWhere('personas.id', $buscar )                  
        ->orWhere('personas.num_doc', $buscar )                  
        ->orderBy('nombreFull', 'asc')->take(1)->get();
      }
      
      return [ 'perso' =>$perso];

  }
}
