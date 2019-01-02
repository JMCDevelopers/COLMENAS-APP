<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Cuenta;
use App\Models\Tareas\Tarea;

class AccountController extends Controller
{
    //

    public function index(){
      $tarea=new Tarea();
      $cuenta=new Cuenta();
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $user = auth()->user();
      $data=array();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      return view('dasboard/account',$data);
    }
    //obtener el id de cuenta de usuario loggeado
    public function getAcountIdUserAuth(){
      $user = auth()->user();
      $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
      return $cuenta->idcuenta_usuario;
    }

    public function getApp(){
      
    }
}
