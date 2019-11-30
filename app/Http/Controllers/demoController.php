<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Equipo;
use App\demo;

class demoController extends Controller
{
    //

    public function upload(Request $request){
        $imagenOriginal = $request->file('imagen');
        if($request->hasFile('imagen') ){
            $ruta = public_path().'/img';
            $imagen = Image::make($imagenOriginal);
            $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();
            $imagen->save($ruta . $temp_name, 100);

        }
    }

    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        // $demo = new demo();
        // $img = $request ->file('imagen');
        // $name = time().'-'.$img->getClientOriginalName();
        // Storage::disk('img')->put($name,file_get_contents($img->getRealPath()));
        // // $demo->id_categoria = $request->id_categoria;
        // // $demo->titulo= $request->titulo;
        // // $demo->texto = $request->texto;
        // $demo->imagen = $name; 
        // $demo->save();

        // $ruta = public_path().'/img/';
        // if($request->hasFile('imagen'))
        // {
            // $imagenOriginal = $request->file('imagen');
            // $filename= time() . '.' . $imagenOriginal->getClientOriginalExtension();
            // $location= public_path('img/' . $filename);
            // $imagen = Image::make($imagenOriginal->getRealPath())->resize(800,400)->save($location);
            // $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();
            // $imagen->save($ruta . $temp_name, 100);
        // $img = $request ->file('image');
        // $nombre=$img->getClientOriginalName();
        // $path=public_path('img/'.$nombre);
        // $url='/img/'.$nombre;
        // $image=Image::make($img->getRealPath());
        // $image->save($path);

          // ruta de las imagenes guardadas
        //   $ruta = public_path().'/img/';
        
        //   if($request->hasFile('image'))
        //   {
            //   $imagenOriginal = $request->file('imagen');
            //   Image::make($imagenOriginal->getRealPath());
            //   $imagen = Image::make($imagenOriginal);
            //   $temp_name = $imagenOriginal->getClientOriginalExtension();
            //   $imagen->save($ruta . $temp_name, 100);
    //   if($request->hasFile('imagen'))
    //     {
            // $file = $request->file('imagen');
            // $name= time().$file->getClientOriginalName();
            // $file->move(public_path().'/img/', $name);

            // $imagenOriginal = $request->file('name');

            // if($request->hasFile('imagen') ){
                // $ruta = public_path().'/img';
                // $imagen = Image::make($imagenOriginal);
                // $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();
                // $imagen->save($ruta . $temp_name, 100);

                // dd($_FILES);
                // dd($request->all());
                      $img = $request->images;
                      $ruta = public_path().'/vehiculos';
                // $nombre=$img[0]->getClientOriginalName();
                $i=0;
                if(count($request->images)){
                    foreach($request->images as $image){
                        $filename = $image->getClientOriginalName();;
                        $upload_success = $image->move($ruta, $filename);

                        // $nombre= $img[$i]->getClientOriginalName();
                        // Storage::disk('vehiculos')->put($nombre,file_get_contents($img[$i]->getRealPath()));
                        // $image->store('vehiculos');
                        $demo = new demo();
                        $demo->imagen =  $filename;
                        $demo->save();
                        $i++;

                    }
                }

            // $demo = new demo();
   
            // $demo->imagen = $ruta;
        
            // $demo->save();
        // } 
    }
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
}
