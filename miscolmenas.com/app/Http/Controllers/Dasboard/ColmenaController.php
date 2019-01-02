<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Menu;
use App\Models\Apiarios\Apiario;
use App\Models\Dashboard\Cuenta;
use App\Models\Comun\TipoColmena;
use App\Models\Comun\Exposicion;
use App\Models\Comun\FuenteColmena;
use App\Models\Comun\Porcentaje;
use App\Models\Colmenas\Material;
use App\Models\Colmenas\Colmena;
use App\Models\Colmenas\MaterialColmena;
use App\Models\Reina\Reina;
use App\Models\Reina\ReinasVenta;
use App\Models\Inspecciones\Inspeccion;
use App\Models\Eventos\Evento;
use App\Models\Reina\RazaReina;
use App\Models\Tareas\Tarea;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class ColmenaController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    //metodo para  carga de inicio
    public function index(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $apiario = new Apiario();
      $colmena=new Colmena();
      $raza=new RazaReina();
      $tarea=new Tarea();
      $cuenta=new Cuenta();
      $user = auth()->user();

      $data=array();
      $data['raza']=$raza->all();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
      $data['apiario']=$apiario->getApiarios($id_cuenta_usuario);
      $data['colmenas']=$colmena->getColmenasUsuario($id_cuenta_usuario);
      return view('colmena/index',$data);
    }

    //consultar por colmena
    public function ObtenerVistaPorApiario($id){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $apiario = new Apiario();
      $colmena=new Colmena();
      $menu=new Menu;
      $raza=new RazaReina();
      $tarea=new Tarea();
      $cuenta=new Cuenta();
      $data=array();
      $data['raza']=$raza->all();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
      $data['apiario']=$apiario->getApiarioById($id);
      $data['colmenas']=$colmena->getColmenasUsuario($id_cuenta_usuario);
      return view('colmena/index',$data);
    }
    //obtener el id de cuenta de usuario loggeado
    public function getAcountIdUserAuth(){
      $user = auth()->user();
      $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
      return $cuenta->idcuenta_usuario;
    }

    //metodo que abre el formulario de crear colmena
    public function CrearColmena(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $apiario = new Apiario();
      $cuenta=new Cuenta();
      $tipo=new TipoColmena();
      $exposicion=new Exposicion();
      $fuente=new FuenteColmena();
      $porcentaje=new Porcentaje();
      $material=new Material();
      $reinas=new Reina();
      $tarea=new Tarea();

      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tipo']=$tipo->all();
      $data['fuente']=$fuente->all();
      $data['exposicion']=$exposicion->all();
      $data['porcentaje']=$porcentaje->all();
      $data['materiales']=$material->all();
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
      $data['reinas']=$reinas->getReinas($id_cuenta_usuario);

      return view('colmena/crear_colmena',$data);
    }

//calcula edad de la reina en base a una fecha dada
    public function CalcularEdadReina(Request $request){
      $datenow=Carbon::now();
      $fecha_inicial=new Carbon($request->fecha_nacimiento);
      $edad=$fecha_inicial->diffInMonths($datenow);
      return response()->json($edad);
    }

    public function CalcularEdadReina2($fecha_nacimiento){
      $datenow=Carbon::now();
      $fecha_inicial=new Carbon($fecha_nacimiento);
      $edad=$fecha_inicial->diffInMonths($datenow);
      return $edad;
    }


    public function insertarColmena(Request $request){
      if($request!=null){
        $input=$request->all();
        $colmena=Colmena::create($input);
        $id=$colmena->idcolmenas;
        return response()->json($id);
      }
    }
    //genera registro de nueva colmena en la base de datos
    public function InsertarColmena2(Request $request){
      $validatedData=$request->validate([
        'identificador_colmena' => 'required|max:50',
        'apiario_idapiario'=>'required'
      ]);
      if($validatedData){
        $user = auth()->user();
        $cuenta=new Cuenta();
        $result=$cuenta->getUserAccount($user->id);
        foreach ($result as $key => $value) {
          $res=$value->num_colmenas;
        }
        $colmena2=new Colmena();
        $id_cuenta_usuario=$this->getAcountIdUserAuth();
        $colmenas_registradas=$colmena2->getColmenasUsuario($id_cuenta_usuario);
        if(count($colmenas_registradas)<$res){
          $input = $request->all();
          $colmena = Colmena::create($input);
          $id=$colmena->idcolmenas;
          if(!is_null($request->idreinas)){
            $reina=Reina::find($request->idreinas);
            $reina->instalado="SI";
            $reina->fecha_instalacion=Carbon::now();
            $reina->save();
          }
          return response()->json($id);
        }else{
          return response()->json("denied");
        }

      }else{
        return response()->json(false);
      }
    }
    //insertar material en base de datos
    public function InsertarComponentesColmena(Request $request){
      if(is_null($request->cadena) || $request->cadena==""){
        return response()->json(true);
      }
      $array_material=array();
      $array_material=explode('&&',$request->cadena);
        if(count($array_material)>0){
          for ($i=0; $i <count($array_material) ; $i++) {
            $material=new MaterialColmena();
            $material->idmaterial=$array_material[$i];
            $material->idcolmenas=$request->id;
            $material->save();
          }
          return response()->json(true);
        }
    }
    // eliminar colmena metodo ajax
    public function EliminarColmena(Request $request){
      try {
        $colmena=new Colmena();
        $colmena->where('idcolmenas',$request->id)->delete();
        return response()->json(true);
      } catch (\Exception $e) {
        return response()->json("Erro:_".$e);
      }
    }


    //abrir formulario de edicion de la colmenas
    public function EditarColmena($id){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $apiario = new Apiario();
      $cuenta=new Cuenta();
      $tipo=new TipoColmena();
      $exposicion=new Exposicion();
      $fuente=new FuenteColmena();
      $porcentaje=new Porcentaje();
      $material=new Material();
      $reinas=new Reina();
      $colmena=new Colmena();
      $tarea=new Tarea();

      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tipo']=$tipo->all();
      $data['fuente']=$fuente->all();
      $data['exposicion']=$exposicion->all();
      $data['porcentaje']=$porcentaje->all();
      $data['materiales']=$material->all();
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['apiarios']=$apiario->getApiarios($id_cuenta_usuario);
      $data['reinas']=$reinas->getReinas($id_cuenta_usuario);
      //$data['reina_detalle']=$reina->find();
      //$data['colmena']=$colmena->getDetalleColmena($id);
      $data['colmena']=$colmena->find($id);
      $data['material_colmena']=$colmena->getMaterialColmena($id);

      return view('colmena/editar_colmena',$data);
    }
      //get reinas disponibles
    public function ObtenerReinasDisponibles(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $reinas=new Reina();
      $result=$reinas->getReinas($id_cuenta_usuario);
      return response()->json($result);
    }
    //Liberar Reina
    public function CambiarReinaColmena(Request $request){
      $colmena = Colmena::find($request->idcolmena);
      $colmena->idreinas=null;
      $colmena->save();

      $reina= Reina::find($request->idreina);
      $reina->instalado="NO";
      $reina->save();

      return response()->json(true);
    }
    //eliminar reina
    public function EliminarReina(Request $request){
      $reina=new Reina();
      $reina->where('idreinas',$request->idreina)->delete();
      return response()->json(true);
    }

    public function ActualizarColmena(Request $request){
      $validatedData=$request->validate([
        'identificador_colmena' => 'required|max:50',
        'apiario_idapiario'=>'required'
      ]);
      if($validatedData){
        $input = $request->all();
        $colmena = Colmena::find($request->idcolmenas);
        $colmena->update($input);
        $id=$colmena->idcolmenas;
        if(!is_null($request->idreinas)){
          $reina=Reina::find($request->idreinas);
          $reina->instalado="SI";
          $reina->fecha_instalacion=Carbon::now();
          $reina->save();
        }
        return response()->json($request->idcolmenas);
      }else{
        return response()->json(false);
      }
    }

    //editar componentes Colmenas
    public function ActualizarComponentes(Request $request){
      if(is_null($request->cadena) || $request->cadena==""){
        $material_colmena=new MaterialColmena();
        $material_colmena->where('idcolmenas',$request->idcolmena)->delete();
        return response()->json(true);
      }
      $material_colmena=new MaterialColmena();
      $material_colmena->where('idcolmenas',$request->idcolmena)->delete();
      $array_material=array();
      $array_material=explode('&&',$request->cadena);
        if(count($array_material)>0){
          for ($i=0; $i <count($array_material) ; $i++) {
            $material=new MaterialColmena();
            $material->idmaterial=$array_material[$i];
            $material->idcolmenas=$request->idcolmena;
            $material->save();
          }
          return response()->json(true);
        }
    }

    //obtener componenste de la colmena
    public function ObtenerComponentesColmena(Request $request){
      $colmena=new Colmena();
      $result=$colmena->getMaterialColmena($request->idcolmena);
      return response()->json($result);
    }

    //obtiene detalle de colmena
    public function getHiveDetails(Request $request){
      $colmena=new Colmena();
      $result=$colmena->getDetalleColmena($request->id);
      return response()->json($result);
    }
    //obtiene detalle de inspeccion
    public function getDetailsInspection(Request $request){
      $inspeccion=new Inspeccion();
      $result=$inspeccion->getInspeccionColmena($request->id);
      return response()->json($result);
    }

    //insertar evento colmena
    public function guardarEventoColmena(Request $request){
      //$input = $request->all();
      $evento =new  Evento();
      $evento->descripcion_evento=$request->descripcion;
      $evento->fecha_evento=$request->fecha_evento;
      $evento->idcolmenas=$request->idcolmenas;
      $evento->save();
      return response()->json(true);
    }

    //obtener eventos colmena
    public function obtenerEventosColmena(Request $request){

        $evento=new Evento();
        $result=$evento->where('idcolmenas',$request->id)->orderByRaw('ideventos desc')->get();
        return response()->json($result);
    }

    //eliminar evento desde ajax
    public function eliminarEvento(Request $request){
      $evento=new Evento();
      $evento->where('ideventos',$request->id)->delete();
      return response()-> json(true);
    }

    // obtener reinas disponibles
    public function getReinasDisponibles(Request $request){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $reinas=new Reina();
      $result=$reinas->getReinas($id_cuenta_usuario);
      return response()->json($result);
    }

    public function guardarReinaColmena(Request $request){
      $reina=new Reina();
      $reina->identificador_reina=$request->identificador_reina;
      $reina->descripcion=$request->descripcion;
      $reina->procedencia=$request->procedencia;
      $reina->instalado="SI";
      $reina->tipo=$request->tipo;
      $reina->fecha_nacimiento=$request->fecha_nacimiento;
      $reina->raza_reina_idraza_reina=$request->raza_reina_idraza_reina;
      $reina->cuenta_usuario_idcuenta_usuario=$this->getAcountIdUserAuth();
      $reina->save();
      $lastIdReina=$reina->idreinas;
      $colmena=Colmena::find($request->idcolmenas);
      $colmena->idreinas=$lastIdReina;
      $colmena->save();
      return redirect('colmena');

    }

    // asignar reina colmena
    public function asignarReinaColmena(Request $request){

      if(!is_null($request->idreina)){
        $colmena=Colmena::find($request->idcolmena);
        $colmena->idreinas=$request->idreina;
        $colmena->save();

        $reina=Reina::find($request->idreina);
        $reina->instalado="SI";
        $reina->fecha_instalacion=Carbon::now();
        $reina->save();
        return response()->json(true);
      }
    }

    public function gestionColmena($idColmena){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $apiario = new Apiario();
      $reina=new Reina();
      $tarea=new Tarea();
      $cuenta=new Cuenta();
      $user = auth()->user();
      $colmena=new Colmena();
      $inspecciones=new Inspeccion();


      $data=array();
      $data['colmena']=$colmena->where('idcolmenas',$idColmena)->first();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['inspecciones']=$inspecciones->getInspeccionesUsuario($id_cuenta_usuario,$idColmena);
      $res=new Colmena();
      $result=$res->where('idcolmenas',$idColmena)->first();
      if(!is_null($result->idReinasVenta)){
        $reina_res=$reina->obtenerReinaVentaColmena($idColmena);
        $data['reina_venta']=$reina_res;
        $data['edad_reina']=$this->CalcularEdadReina2($reina_res->fecha_nacimiento);
      }else if(!is_null($result->idreinas)){
        $reina_res=$reina->obtenerReinaColmena($idColmena);
        $data['reina']=$reina_res;
        $data['edad_reina']=$this->CalcularEdadReina2($reina_res->fecha_nacimiento);
      }
      return view('colmena/gestion_colmenas',$data);
    }


    // editar datos colmenas
public function editarIdentificador(Request $request){
  try {
    $colmena=Colmena::find($request->id_colmena);
    $colmena->identificador_colmena=$request->identificador_colmena;
    $r=$colmena->save();
    if($r>0){
      return response()->json(true);
    }
    return response()->json(false);
  } catch (\Exception $e) {
    return response()->json("Erro:_".$e);
  }
}

public function editarDescripcion(Request $request){
  try {
      $colmena=Colmena::find($request->id_colmena);
      $colmena->descripcion=$request->descripcion_colmena;
      $res=$colmena->save();
      if($res>0){
        return response()->json(true);
      }
    return response()->json(false);
  } catch (\Exception $e) {
    return response()->json("Erro:_".$e);
  }

}

public function editarTipoColmena(Request $request){
  try {
    $colmena=Colmena::find($request->id_colmena);
    $colmena->tipo_colmena=$request->tipo_colmena;
    $res=$colmena->save();
    if($res>0){
      return response()->json(true);
    }
    return response()->json(false);
  } catch (\Exception $e) {
    return response()->json("Erro:_".$e);
  }
}

public function editarOrigenColmena(Request $request){
try {
  $colmena=Colmena::find($request->id_colmena);
  $colmena->procedencia_colmena=$request->origen_colmena;
  $res=$colmena->save();
  if($res>0){
    return response()->json(true);
  }
  return response()->json(false);
} catch (\Exception $e) {
  return response()->json("Erro:_".$e);
}

}
    // fin editar datos colmena

public function eliminarReinaColmena(Request $request){
  try {
    $colmena = Colmena::find($request->id_colmena);
    if(!is_null($colmena->idreinas)){
      $id_reina=$colmena->idreinas;
      $reina=Reina::find($id_reina);
      $res=$reina->delete();
      if($res){
        return response()->json(true);
      }else{
        return response()->json(false);
      }
    }
    if(!is_null($colmena->idReinasVenta)){
        $reina=ReinasVenta::find($colmena->idReinasVenta);
        $reina->borrado=1;
        $reina->estado=0;
        $reina->save();
        $colmena=Colmena::find($request->id_colmena);
        $colmena->idReinasVenta=null;
        $r=$colmena->save();
        if($r>0){
          return response()->json(true);
        }else{
          return response()->json(false);
        }
    }
  } catch (\Exception $e) {
    return response()->json("Erro:_".$e);
  }
}

// ingresar inspeccion colmenas
public function insertarInspeccionColmena(Request $request){
  try {
    if($request->tipo_transaccion==1){
      $inspeccion = new Inspeccion();
      $inspeccion->idcolmenas=$request->id_colmena;
      $inspeccion->fecha_inspeccion=$request->fecha_inspeccion;
      $inspeccion->reina=$request->reina;
      $inspeccion->postura=$request->postura_reina;
      $inspeccion->albeolos=$request->celdas_reales;
      $inspeccion->crias_nacidas=$request->cria;
      $inspeccion->fuerza_poblacion=$request->poblacion;
      $inspeccion->temperamento_colmena=$request->temperamento;
      $inspeccion->reservas_polen=$request->polen;
      $inspeccion->reservas_miel=$request->miel;
      $inspeccion->observaciones=$request->obervaciones_inspeccion;
      $inspeccion->enfermedad=$request->enfermedades;
      $inspeccion->descripcion_enfermedades=$request->tratamientos_colmena;
      if(!is_null($request->imagen_inspeccion)){
        $path1=Storage::disk('public')->put('inspeccion',$request->imagen_inspeccion);
        $inspeccion->imagen_inspeccion=$path1;
      }
      $res=$inspeccion->save();
      if($res>0){
        return redirect('gestion-colmena/'.$request->id_colmena);
      }
      return response()->json(false);
    }

    // update
    if($request->tipo_transaccion==2){
      $inspeccion = Inspeccion::find($request->id_inspeccion);
      $inspeccion->idcolmenas=$request->id_colmena;
      $inspeccion->fecha_inspeccion=$request->fecha_inspeccion;
      $inspeccion->reina=$request->reina;
      $inspeccion->postura=$request->postura_reina;
      $inspeccion->albeolos=$request->celdas_reales;
      $inspeccion->crias_nacidas=$request->cria;
      $inspeccion->fuerza_poblacion=$request->poblacion;
      $inspeccion->temperamento_colmena=$request->temperamento;
      $inspeccion->reservas_polen=$request->polen;
      $inspeccion->reservas_miel=$request->miel;
      $inspeccion->observaciones=$request->obervaciones_inspeccion;
      $inspeccion->enfermedad=$request->enfermedades;
      $inspeccion->descripcion_enfermedades=$request->tratamientos_colmena;
      if(!is_null($request->imagen_inspeccion)){
        $path1=Storage::disk('public')->put('inspeccion',$request->imagen_inspeccion);
        $inspeccion->imagen_inspeccion=$path1;
      }
      $res=$inspeccion->save();
      if($res>0){
        return redirect('gestion-colmena/'.$request->id_colmena);
      }
      return response()->json(false);
    }

  } catch (\Exception $e) {
    return response()->json("Erro:_".$e);
  }

}
// obtener inspeccion colmena
public function getInspeccionColmena(Request $request){
  try {
    $inspeccion = Inspeccion::find($request->id_inspeccion);
    return response()->json($inspeccion);
  } catch (\Exception $e) {
    return response()->json("Erro:_".$e);
  }

}

// eliminar inspeccion
public function eliminarInspeccionColmena(Request $request){
  try {
    $inspeccion=Inspeccion::find($request->id_inspeccion);
    $res=$inspeccion->delete();
    if($res>0){
      return response()->json(true);
    }else{
      return response()->json(false);
    }
  } catch (\Exception $e) {
    return response()->json("Erro:_".$e);
  }

}




}
