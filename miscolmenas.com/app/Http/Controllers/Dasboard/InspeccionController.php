<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\dashboard\Menu;
use App\Models\Apiarios\Apiario;
use App\Models\Colmenas\Material;
use App\Models\Dashboard\Cuenta;
use App\Models\Colmenas\Colmena;
use App\Models\Comun\Exposicion;
use App\Models\Inspecciones\Alimentacion;
use App\Models\Inspecciones\Inspeccion;
use App\Models\Inspecciones\CondicionesColmena;
use App\Models\Inspecciones\Enfermedad;
use App\Models\Inspecciones\Tratamientos;
use App\Models\Inspecciones\AlimentacionColmena;
use App\Models\Inspecciones\ImagenInspeccion;
use App\Models\Tareas\Tarea;
use Illuminate\Support\Facades\Storage;

class InspeccionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  //obtener el id de cuenta de usuario loggeado
  public function getAcountIdUserAuth(){
    $user = auth()->user();
    $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
    return $cuenta->idcuenta_usuario;
  }

  //iniciar pagina de index  inspecciones
    public function index(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $apiario = new Apiario();
      $cuenta=new Cuenta();
      $tarea=new Tarea();
      $inspeccion=new Inspeccion();
      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['inspecciones']=$inspeccion->getInspeccionesUsuario($id_cuenta_usuario);
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
      return view('inspecciones/index',$data);
    }

    //formulario de registro de inspeccion
    public function nuevaInspeccion($id,$valor){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $exposicion=new Exposicion();
      $colmena=Colmena::find($id);
      $cuenta=new Cuenta();
      $tarea=new Tarea();
      $data=array();
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['colmena']=$colmena;
      $data['valor']=$valor;
      $data['exposicion']=$exposicion->all();
      $data['alimentacion']=Alimentacion::all();
      $data['cuenta_usuario']=$this->getAcountIdUserAuth();
      return view('inspecciones/nueva_inspeccion',$data);
    }

    //obtiene colmenas por apiario
    public function ObtenerColmenasApiario(Request $request){
      $colmena=new Colmena();
      $result=$colmena->where('apiario_idapiario',$request->id)->get();
      return response()->json($result);
    }
    //ingresar inspecciones
    public function ingresarInspeccion(Request $request){

      $input=$request->all();
      $inspeccion=Inspeccion::create($input);
      $id=$inspeccion->idinspeccion_colmena;
      return response()->json($id);
    }

    //guardar condiciones de la colmena
    public function guardarCondicionesColmena(Request $request){
      if(!is_null($request->cadena)){
        $cadena=array();
        $cadena=explode('&&',$request->cadena);
        $id=$request->id;
        for ($i=0; $i < count($cadena); $i++) {
          $condicion=new CondicionesColmena();
          $condicion->nombre_condicion=$cadena[$i];
          $condicion->idinspeccion_colmena=$id;
          $condicion->save();
        }
        return response()->json(true);
      }else{
        return response()->json(false);
      }
    }

    //guardar Enfermedades
    public function guardarEnfermedadColmena(Request $request){
      if(!is_null($request->cadena)){
        $cadena=array();
        $cadena=explode('&&',$request->cadena);
        $id=$request->id;
        for ($i=0; $i < count($cadena); $i++) {
          $enfermedad=new Enfermedad();
          $enfermedad->nombre_enfermedad=$cadena[$i];
          $enfermedad->idinspeccion_colmena=$id;

          $enfermedad->save();
        }
        if(!is_null($request->otros)){
          $enfermedad2=new Enfermedad();
          $enfermedad2->nombre_enfermedad=$request->otros;
          $enfermedad2->idinspeccion_colmena=$id;
          $enfermedad2->save();
        }
        return response()->json(true);
      }else{
        if(!is_null($request->otros)){
          $enfermedad2=new Enfermedad();
          $enfermedad2->nombre_enfermedad=$request->otros;
          $enfermedad2->idinspeccion_colmena=$request->id;
          $enfermedad2->save();
          return response()->json(true);
        }
        return response()->json(false);
      }
    }

    // guardar tratamientos colmenas
    public function guardarTratamientoColmena(Request $request){
      if(!is_null($request->cadena)){
        $cadena=array();
        $cadena=explode('&&',$request->cadena);
        $id=$request->id;
        for ($i=0; $i < count($cadena); $i++) {
          $tratamiento=new Tratamientos();
          $tratamiento->nombre_tratamiento=$cadena[$i];
          $tratamiento->idinspeccion_colmena=$id;
          $tratamiento->save();
        }
        if(!is_null($request->otros)){
          $tratamiento=new Tratamientos();
          $tratamiento->nombre_tratamiento=$request->otros;
          $tratamiento->idinspeccion_colmena=$id;
          $tratamiento->save();
        }
        return response()->json(true);
      }else{
        if(!is_null($request->otros)){
          $tratamiento=new Tratamientos();
          $tratamiento->nombre_tratamiento=$request->otros;
          $tratamiento->idinspeccion_colmena=$request->id;
          $tratamiento->save();
          return response()->json(true);
        }
        return response()->json(false);
      }
    }

    // guardar aliemtacion
    public function guardarAliemtacionColmena(Request $request){
      if(!is_null($request->cadena)){
        $cadena=array();
        $cadena=explode('&&',$request->cadena);
        $id=$request->id;
        for ($i=0; $i < count($cadena); $i++) {
          $alimento=new AlimentacionColmena();
          $alimento->nombre_alimento=$cadena[$i];
          $alimento->idinspeccion_colmena=$id;
          $alimento->save();
        }
        if(!is_null($request->otros)){
          $alimento=new AlimentacionColmena();
          $alimento->nombre_alimento=$request->otros;
          $alimento->idinspeccion_colmena=$id;
          $alimento->save();
        }
        return response()->json(true);
      }else{
        if(!is_null($request->otros)){
          $alimento=new AlimentacionColmena();
          $alimento->nombre_alimento=$request->otros;
          $alimento->idinspeccion_colmena=$request->id;
          $alimento->save();
          return response()->json(true);
        }
        return response()->json(false);
      }
    }

    //guardar tarea colmena

    public function guardarTarea(Request $request){
      if(!is_null($request->title)){
        $input=$request->all();
        $result=Tarea::create($input);
        $insertId=$result->idtareas;
        if($result){
          $tarea=Tarea::find($insertId);
          $tarea->url="editar-tarea/".$insertId;
          $tarea->save();
          return response()->json(true);
        }else{
          return response()->false(false);
        }
      }
    }

    //guardar imagenes inspeccion
    public function guardarImagenesInspeccion(Request $request){
      if(!is_null($request->imagen_uno)){
        $path1=Storage::disk('public')->put('inspeccion',$request->imagen_uno);
        $img=new ImagenInspeccion();
        $img->url_imagen_inspeccion=$path1;
        $img->idinspeccion_colmena=$request->id_apiario_img;
        $img->save();
      }
      if(!is_null($request->imagen_dos)){
        $path2=Storage::disk('public')->put('inspeccion',$request->imagen_dos);
        $img=new ImagenInspeccion();
        $img->url_imagen_inspeccion=$path2;
        $img->idinspeccion_colmena=$request->id_apiario_img;
        $img->save();
      }
      if(!is_null($request->imagen_tres)){
        $path3=Storage::disk('public')->put('inspeccion',$request->imagen_tres);
        $img=new ImagenInspeccion();
        $img->url_imagen_inspeccion=$path3;
        $img->idinspeccion_colmena=$request->id_apiario_img;
        $img->save();
      }
      if($request->valor=="m"){
        return redirect('colmena');
      }else if($request->valor=="n"){
        return redirect('inspeccion');
      }

    }
    //eliminar registro colmena
    public function eliminarInspeccion(Request $request){
      $inspeccion=new Inspeccion();
      $inspeccion->where('idinspeccion_colmena',$request->id)->delete();
      return response()->json(true);
    }
    //obtener detalle colmena
    public function obtenerDetalleInspeccion(Request $request){
        $inspeccion=new Inspeccion();
        $result=$inspeccion->getInspeccion($request->id);
        return response()->json($result);
    }
    //obtener codiciones de la colmena
    public function obtenerCondicionesColmena(Request $request){
       $condiciones=new CondicionesColmena();
       $result=$condiciones->where('idinspeccion_colmena',$request->id)->get();
       return response()->json($result);
    }
    //obtener enfermedadesColmena
    public function obtenerEnfermedadesColmena(Request $request){
      $enfermedad=new Enfermedad();
      $result=$enfermedad->where('idinspeccion_colmena',$request->id)->get();
      return response()->json($result);
    }
    //obtiene tratamientos
    public function obtenerTratamientosColmenas(Request $request){
      $tratamiento=new Tratamientos();
      $result=$tratamiento->where('idinspeccion_colmena',$request->id)->get();
      return response()->json($result);
    }
    //obtiene alimentos de la colmena proporcionados en el inspeccion
    public function AlimentosProporcionados(Request $request){
      $alimento=new AlimentacionColmena();
      $result=$alimento->where('idinspeccion_colmena',$request->id)->get();
      return response()->json($result);
    }
    // obtiene Imagenes de la inspeccion
    public function obtenerImagenesInspeccion(Request $request){
      $imagen=new ImagenInspeccion();
      $result=$imagen->where('idinspeccion_colmena',$request->id)->get();
      return response()->json($result);
    }

    //editar INSPECCION
    public function editarinspeccion($id){
      $exposicion=new Exposicion();
      $inspeccion=new Inspeccion();
      $colmena=new Colmena();
      $cuenta=new Cuenta();
      $inspe=Inspeccion::find($id);;
      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['inspeccion']=$inspe;
      $result=Colmena::find($inspe->idcolmenas);
      $data['colmena']=$result;
      $data['exposicion']=$exposicion->all();
      $data['alimentacion']=Alimentacion::all();
      $data['cuenta_usuario']=$this->getAcountIdUserAuth();
      return view('inspecciones/editarInspeccion',$data);
    }

    public function actualizarInspeccion(Request $request){
      $condiciones=new CondicionesColmena();
      $enfermedades=new Enfermedad();
      $tratamientos=new Tratamientos();
      $alimentacion=new AlimentacionColmena();
      $imagen=new ImagenInspeccion();

      $condiciones->where('idinspeccion_colmena',$request->idinspeccion_colmena)->delete();
      $enfermedades->where('idinspeccion_colmena',$request->idinspeccion_colmena)->delete();
      $tratamientos->where('idinspeccion_colmena',$request->idinspeccion_colmena)->delete();
      $alimentacion->where('idinspeccion_colmena',$request->idinspeccion_colmena)->delete();
      $imagen->where('idinspeccion_colmena',$request->idinspeccion_colmena)->delete();

      $inspeccion=Inspeccion::find($request->idinspeccion_colmena);
      $input=$request->all();
      $inspeccion->update($input);

      return response()->json($request->idinspeccion_colmena);
    }

}
