<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Menu;
use App\Models\Dashboard\Cuenta;
use Illuminate\Support\Facades\Validator;
use App\Models\Tareas\Tarea;
use Illuminate\Support\Facades\Hash;
use App\User;

class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
public function index(){
  $id_cuenta_usuario=$this->getAcountIdUserAuth();
  $cuenta=new Cuenta();
  $tarea=new Tarea();


  $data=array();
  $user = auth()->user();
  $data['permisos']=$cuenta->getUserAccount($user->id);
  $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
  return view('dasboard/index',$data);
}

public function ObtenerMenu(){

}

public function getTaskUser(){
  $id_cuenta_usuario=$this->getAcountIdUserAuth();
  $tarea=new Tarea();
  $result=$tarea->getTareasPendientes($id_cuenta_usuario);
  return response()->json($result);
}
//obtener el id de cuenta de usuario loggeado
public function getAcountIdUserAuth(){
  $user = auth()->user();
  $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
  return $cuenta->idcuenta_usuario;
}

//gestion de tarteas
public function gestionarTareas(){
  $id_cuenta_usuario=$this->getAcountIdUserAuth();
$cuenta=new Cuenta();
  $tarea=new Tarea();
  $data=array();
  $user = auth()->user();
  $data['permisos']=$cuenta->getUserAccount($user->id);
  $data['cuenta_usuario']=$id_cuenta_usuario;
  $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
  $data['tareas_realizadas']=$tarea->where('idcuenta_usuario',$id_cuenta_usuario)->where('estado','1')->get();
  return view('dasboard/tareas',$data);
}

// editar Tarea
public function editarTarea($id){
    $id_cuenta_usuario=$this->getAcountIdUserAuth();
    $cuenta=new Cuenta();
    $tarea=new Tarea();
    $data=array();
    $user = auth()->user();
    $data['permisos']=$cuenta->getUserAccount($user->id);
    $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
    $data['tarea']=$tarea=Tarea::find($id);
    return view('dasboard/update_tarea',$data);
}

//RECORDINAR FECHA TAREA
public function recordinarFechaTarea(Request $request){
  $tarea=Tarea::find($request->id);
  $tarea->start=$request->start;
  $tarea->save();
  return response()->json(true);

}
// finakizar Tarea
public function finalizarTarea(Request $request){
  $tarea=Tarea::find($request->id);
  $tarea->estado="1";
  $tarea->color="#D5F4C0";
  $res=$tarea->save();
  if($res){
    return response()->json(true);
  }else{
    return response()->json(false);
  }

}
  //eliminar Tarea
public function eliminarTarea(Request $request){
  $tarea=new Tarea();
  $result=$tarea->where('idtareas',$request->id)->delete();
  return response()->json(true);
}

public function cambiarPassword(){

  $id_cuenta_usuario=$this->getAcountIdUserAuth();
  $cuenta=new Cuenta();
  $tarea=new Tarea();
  $data=array();
  $user = auth()->user();
  $data['permisos']=$cuenta->getUserAccount($user->id);
  $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
  return view('dasboard/cambiarPassword',$data);
}

//funccion cambia contraseña
public function actualizarPassword(Request $request){
  $validatedData=$request->validate([
    'password' => 'required|string|min:6|confirmed',
  ]);
  if($validatedData){
    $user = auth()->user();
    $usuario=User::find($user->id);
    $usuario->password=Hash::make($request->password);
    $usuario->save();
    return redirect()->route('dashboard');
  }
}



}
