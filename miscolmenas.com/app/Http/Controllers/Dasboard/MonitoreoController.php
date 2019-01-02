<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Menu;
use App\Models\Tareas\Tarea;
use App\Models\Dashboard\Cuenta;

class MonitoreoController extends Controller
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

    public function index(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $tarea=new Tarea();

      $data=array();
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      return view('monitoreo/index',$data);
    }
}
