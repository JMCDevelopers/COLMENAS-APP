<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Menu;
use App\Models\Cosechas\ProductoColmena;
use App\Models\Cosechas\UnidadMedida;
use App\Models\Colmenas\Colmena;
use App\Models\Apiarios\Apiario;
use App\Models\Dashboard\Cuenta;
use App\Models\Cosechas\Cosecha;
use Illuminate\Support\Facades\Storage;
use App\Models\Tareas\Tarea;

class CosechaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  //iniciar interfaz de cosechas
    public function index(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $user = auth()->user();
      $producto=new ProductoColmena();
      $unidad=new UnidadMedida();
      $apiario=new Apiario();
      $tarea=new Tarea();
      $cuenta=new Cuenta();

      $data=array();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['producto']=$producto->all();
      $data['unidad']=$unidad->all();
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);

      return view('cosechas/index',$data);
    }

    public function CrearCosecha(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $user = auth()->user();
      $producto=new ProductoColmena();
      $unidad=new UnidadMedida();
      $apiario=new Apiario();
      $tarea=new Tarea();
      $cuenta=new Cuenta();
      $data=array();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['producto']=$producto->all();
      $data['unidad']=$unidad->all();
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);

      return view('cosechas/index',$data);
    }
    //obtener el id de cuenta de usuario loggeado
    public function getAcountIdUserAuth(){
      $user = auth()->user();
      $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
      return $cuenta->idcuenta_usuario;
    }
    //obtener colmenas por apiario
    public function ObtenerColmenasApiario(Request $request){
      $colmena=new Colmena();
      $result=$colmena->where('apiario_idapiario',$request->id)->get();
      return response()->json($result);
    }

    //guardar registro de cosecha en la db
    public function GuardarCosecha(Request $request){
      $cosecha=new Cosecha();
      $cosecha->fecha_cosecha=$request->fecha_cosecha;
      $cosecha->descripcion=$request->descripcion;
      $cosecha->cantidad=$request->cantidad;
      $cosecha->unidad_medida=$request->unidad_medida;
      $cosecha->producto=$request->producto;
      $cosecha->colmenas_cosechadas=$request->colmenas_cosechadas;
      $cosecha->idapiario=$request->idapiario;
      $cosecha->save();
      $id=$cosecha->idcosechas;
      if(!is_null($request->imagen_cosecha)){
      $path=Storage::disk('public')->put('cosechas',$request->imagen_cosecha);
      $cosecha2=Cosecha::find($id);
      $cosecha2->url_imagenl=$path;
      $cosecha2->save();
      }
      return redirect()->route('lista_cosechas');

    }

    public function ListaCosechas(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cosecha=new Cosecha();
      $menu=new Menu();
      $tarea=new Tarea();
      $cuenta=new Cuenta();
      $data=array();
      $data['cosechas']=$cosecha->getCosechasReporte($id_cuenta_usuario);
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      return view('cosechas/cosechas',$data);
    }
    //eliminar Cosecha
    public function EliminarCosecha(Request $request){
      $cosecha=new Cosecha();
      $cosecha->where('idcosechas',$request->id)->delete();
      return response()->json(true);
    }

    //editar cosechas
    public function EditarCosecha($id){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $producto=new ProductoColmena();
      $unidad=new UnidadMedida();
      $apiario=new Apiario();
      $tarea=new Tarea();

      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['producto']=$producto->all();
      $data['unidad']=$unidad->all();
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
      $data['cosecha_editar']=$cosecha=Cosecha::find($id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $cosechas=$cosecha=Cosecha::find($id);
      $colmenas=explode('&&',$cosechas->colmenas_cosechadas);
      $data['colmenas']=$colmenas;

      return view('cosechas/editarCosecha',$data);
    }

    //actualizar registro de cosecha en BD
    public function ActualizarCosecha(Request $request){

      $cosecha=Cosecha::find($request->idcosechas);
      $cosecha->fecha_cosecha=$request->fecha_cosecha;
      $cosecha->descripcion=$request->descripcion;
      $cosecha->cantidad=$request->cantidad;
      $cosecha->unidad_medida=$request->unidad_medida;
      $cosecha->producto=$request->producto;
      $cosecha->colmenas_cosechadas=$request->colmenas_cosechadas;
      $cosecha->idapiario=$request->idapiario;
      $cosecha->save();
      $id=$cosecha->idcosechas;
      if(!is_null($request->imagen_cosecha)){
      $path=Storage::disk('public')->put('cosechas',$request->imagen_cosecha);
      $cosecha2=Cosecha::find($id);
      $cosecha2->url_imagenl=$path;
      $cosecha2->save();
      }
      return redirect()->route('lista_cosechas');
    }

    //obtiene detalle de cosechas
    public function getCosechaDetalle(Request $request){
      $cosecha=new Cosecha();
      $result=$cosecha->getDetalleCosecha($request->id);
      return response()->json($result);
    }

    //obtiene info colmena
    public function ObtenerColmena(Request $request){
      $colmena=Colmena::find($request->id);
      return response()->json($colmena);
    }
}
