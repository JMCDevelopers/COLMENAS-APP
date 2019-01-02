<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Menu;
use App\Models\Reina\RazaReina;
use App\Models\Reina\Reina;
use App\Models\Colmenas\Colmena;
use App\Models\Reina\ReinasVenta;
use App\Models\Dashboard\Cuenta;
use Carbon\Carbon;
use App\Models\Tareas\Tarea;

class ReinaController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $raza=new RazaReina();
      $tarea=new Tarea();
      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['raza']=$raza->all();
      return view('reinas/index',$data);
    }

    //metodo poara crear la reina recibe los parametros desde el formulario de Creacion
    public function CrearReina(Request $request){
      try {
        $reina=new Reina();
        $reina->identificador_reina=$request->identificador_reina;
        $reina->raza=$request->raza;
        $reina->origen_reina=$request->origen_reina;
        $reina->fecha_nacimiento=$request->fecha_nacimiento;
        $reina->cuenta_usuario_idcuenta_usuario=$this->getAcountIdUserAuth();
        $reina->save();
        $id=$reina->idreinas;

        $colmena = Colmena::find($request->id_colmena);
        $colmena->idreinas=$id;
        $colmena->save();

        if($colmena){
            return response()->json(true);
        }else{
          return response()->json(false);
        }
      } catch (\Exception $e) {
        return response()->json("error : ".$e);
      }


    }

    public function insertarReinaVenta(Request $request){
      try {
        $colmena= Colmena::find($request->id_colmena);
        $colmena->idReinasVenta=$request->idReinasVenta;
        $colmena->save();

        $reinaVenta=ReinasVenta::find($request->idReinasVenta);
        $reinaVenta->estado=1;
        $reinaVenta->idCuentaUsuario=$this->getAcountIdUserAuth();
        $reinaVenta->save();
        if($reinaVenta){
          return response()->json(true);
        }else{
          return response()->json(false);
        }
      } catch (\Exception $e) {
        return response()->json("error : ".$e);
      }
    }

    public function ObtenerReinas(){
      $id=$this->getAcountIdUserAuth();
      $reinas= new Reina();
      $data=array();
      $data['reinas']=$reinas->getReinas($id);
      return view('reinas/tabla_reinas',$data);
    }
    public function ObtenerReinasInstaladas(){
      $id=$this->getAcountIdUserAuth();
      $reinas= new Reina();
      $data=array();
      $data['reinas']=$reinas->getReinasInstaladas($id);
      return view('reinas/tabla_reinas_instaladas',$data);
    }
    //obtener el id de cuenta de usuario loggeado
    public function getAcountIdUserAuth(){
      $user = auth()->user();
      $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
      return $cuenta->idcuenta_usuario;
    }

    //metodo eliminar  reinas
    public function EliminarReina(Request $request){
      $reina=new Reina();
      $reina->where('idreinas',$request->idreina)->delete();
      return redirect()->route('reina');
    }
    //método envia datos al formulario de edicion
    public function EditaReina($id){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $raza=new RazaReina();
      $reina = new Reina();
      $tarea=new Tarea();
      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['raza']=$raza->all();
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['reina']=$reina->find($id);
      return view('reinas/editar_reina',$data);
    }

    //actualizar registro apiario
    public function ActualizarReina(Request $request){
      $validatedData=$request->validate([
        'identificador_reina' => 'required|max:50',
        'descripcion' => 'required',
        'procedencia' => 'required',
        'fecha_nacimiento'=>'required',
        'tipo'=>'required',
        'raza_reina_idraza_reina' => 'required',
      ]);
      if($validatedData){
        $reina=Reina::find($request->idreina);
        $input=$request->all();
        $reina->update($input);
        return redirect()->route('reina');
      }
    }


    //metodo ajax
    public function ObtenerDetalleReina(Request $request){
      $reina=new Reina();
      $res=$reina->getReinasDetalle($request->id);
      return response()->json($res);
    }


    public function Pruebas(){
    //  $fechainicial=new DateTime("2018-03-01");
      //$fechainicial=$fechainicial->format('Y-m-d');
      $date1=new Carbon("2018-01-01");
      $finaldate=Carbon::now();
      $result=$date1->diffInMonths($finaldate);
    //  $diferencia = $fechainicial->diff($fechafinal);
      return $result;
    }

    public function getCodigoSeguimientoReina(Request $request){
          $reinasVenta=new ReinasVenta();
          $res=$reinasVenta->where('identificador_reina',$request->codigo)->where('estado',0)->where('borrado',0)->first();
          return response()->json($res);
    }
}
