<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Dashboard\Menu;
use App\Models\Dashboard\Provincia;
use App\Models\Apiarios\Apiario;
use App\Models\Apiarios\InspeccionApiario;
use App\Models\Dashboard\Cuenta;
use App\Models\Tareas\Tarea;
use App\Models\Colmenas\Colmena;
use GMaps;
use Illuminate\Support\Facades\Storage;

class ApiarioController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(){
    $cuenta=new Cuenta();

    $provincia=new Provincia();
    $tarea=new Tarea();
    $id_cuenta_usuario=$this->getAcountIdUserAuth();
    $user = auth()->user();
    $data=array();
    $data['permisos']=$cuenta->getUserAccount($user->id);
    $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
    $data['provincias']=$provincia->all();
    //$data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
    return view('apiario/index',$data);
  }
  //obtener el id de cuenta de usuario loggeado
  public function getAcountIdUserAuth(){
    $user = auth()->user();
    $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
    return $cuenta->idcuenta_usuario;
  }

  public function GenerarTablaApiarios(){
    $id_cuenta_usuario=$this->getAcountIdUserAuth();
    $apiario = new Apiario();
    $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
    return view('apiario/tabla_api',$data);
  }
  //ingresar apiario en la base de datos
  public function createApiario(Request $request){

    $validatedData=$request->validate([
      'nombre_apiario' => 'required|max:50',
      'direccion' => 'required',
      'provincia' => 'required',
      'descripcion' => 'required',
      'establecimiento' => 'required',
    ]);

    if($validatedData){
      $apiario=new Apiario();
      $apiario->nombre_apiario=$request->nombre_apiario;
      $apiario->descripcion=$request->descripcion;
      $apiario->direccion=$request->direccion;
      $apiario->latitud=$request->latitud;
      $apiario->longitud=$request->longitud;
      $apiario->provincia_idprovincia=$request->provincia;
      $apiario->cuenta_usuario_idcuenta_usuario=$this->getAcountIdUserAuth();
      $apiario->establecimiento=$request->establecimiento;
      $apiario->save();
      return redirect()->route('apiario');
    }
  }

  public function DeleteApiario(Request $request){
    $colmena=new Colmena();
    $result=$colmena->where('apiario_idapiario',$request->idapiario)->get();
    if(count($result)<=0){
      $apiario=new Apiario();
      $res=$apiario->where('idapiario',$request->idapiario)->delete();
      return response()->json(true);
    }else{
      return response()->json(false);
    }

  }

//abrir formulario de edicion para los apiarios
  public function EditaApiario($id){
    $id_cuenta_usuario=$this->getAcountIdUserAuth();
    $menu=new Menu();
    $provincia=new Provincia();
    $tarea=new Tarea();
    $cuenta=new Cuenta();
    $data=array();
    $user = auth()->user();
    $data['permisos']=$cuenta->getUserAccount($user->id);
    $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
    $data['provincias']=$provincia->all();
    $apiario = new Apiario();
    $data['dato']=$apiario->where('idapiario',$id)->get();
    return view('apiario/editarapiario',$data);
  }

  //funcion que realiza la afectación de la tabla de apiarios en la base de datos
  public function ActualizarApiario(Request $request){
    $validatedData=$request->validate([
      'nombre_apiario' => 'required|max:50',
      'direccion' => 'required',
      'provincia' => 'required',
      'descripcion' => 'required',
      'establecimiento' => 'required',
    ]);

    if($validatedData){
      $apiario=Apiario::find($request->idapiario);
      $input=$request->all();
      $apiario->update($input);
      return redirect()->route('apiario');
    }

  }
// metodo para obtener el detalle del apiario
  public function ObtenerDetalleApiario(Request $request){
    $apiario = new Apiario();
    $result=$apiario->where('idapiario',$request->id)->get();
    return response()->json($result);
  }

  //metodo obtiene inspeccion por apiario
  public function obtenerInspeccionApiario(Request $request){
      $inspeccion=new InspeccionApiario();
      $result=$inspeccion->getInspeccionApiario($request->idapiario);
      return response()->json($result);
  }

  //obtiene nombre de provincia desde ajax
  public function ObtenerProvinciaAjax(Request $request){
    $provincia = new Provincia();
    $result=$provincia->where('idprovincia',$request->id)->get();
    return response()->json($result);
  }

  public function ObtenerColmenasApiario(){

  }
  //obtiene datos de geolocalizacion de apiario
  public function ObtenerMapaApiario($id){
    $apiario = new Apiario();
    $result_apiario=$apiario->find($id);
    $pos="".$result_apiario->latitud.",".$result_apiario->longitud."";
    $config=array();
    $config['center']=$pos;
    $config['zoom']='16';
    $config['map_height']='500px';
    $config['scrollwheel']=false;
    GMaps::initialize($config);
    $marker=array();
    $marker['position']=$pos;
    $marker['infowindow_content']='Apiario: Los Sauces';
    GMaps::add_marker($marker);
    $circle = array();
    $circle['center'] = $pos;
    $circle['radius'] = '50';
    GMaps::add_circle($circle);
    $map=GMaps::create_map();
    return view('apiario/map')->with('map', $map);
  }

  public function inspeccionarApiario($id){
    $id_cuenta_usuario=$this->getAcountIdUserAuth();
    $menu=new Menu();
    $provincia=new Provincia();
    $tarea=new Tarea();
    $cuenta=new Cuenta();

    $data=array();
    $user = auth()->user();
    $data['permisos']=$cuenta->getUserAccount($user->id);
    $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
    $data['provincias']=$provincia->all();
    $data['apiario']=Apiario::find($id);
    $data['cuenta_usuario']=$id_cuenta_usuario;
    return view('apiario/inspeccion_apiario',$data);
  }

//insertar inspeccion de apiario
  public function insertarInspeccionApiario(Request $request){
    $inspeccion=new InspeccionApiario();
    $inspeccion->detalle_inspeccion=$request->detalle_inspeccion;
    $inspeccion->fecha_inspeccion=$request->fecha_inspeccion;
    //$inspeccion->clima_apiario=$request->clima_apiario;
    //$inspeccion->mantenimiento=$request->mantenimiento;
    if(!is_null($request->imagen1)){
      $path1=Storage::disk('public')->put('inspeccion',$request->imagen1);
      $inspeccion->imagen1=$path1;
    }
    $inspeccion->idapiario=$request->idapiario;
    $inspeccion->save();
    $inspeccion->idinspeccion_apiario;
    if(!is_null($request->descripcion_tarea) && !is_null($request->title)){
      $descricpion_nueva="Tarea para Apiario:".$request->nombre_apiario."--".$request->descripcion_tarea;
      $tarea=new Tarea();
      $tarea->title=$request->title;
      $tarea->descripcion_tarea=$descricpion_nueva;
      $tarea->start=$request->start;
      $tarea->color=$request->color;
      $tarea->tipo=$request->tipo;
      $tarea->estado="0";
      $tarea->idcuenta_usuario=$this->getAcountIdUserAuth();
      $tarea->save();
      $idtarea=$tarea->idtareas;
      if($idtarea){
        $tr=Tarea::find($idtarea);
        $tr->url="editar-tarea/".$idtarea;
        $tr->save();
      }
    }
    return redirect()->route('apiario');

  }


}
