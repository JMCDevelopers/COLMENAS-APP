<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Colmenas\Colmena;
use App\Models\Dashboard\Cuenta;
use Mail;
Use QRCode;
class TestController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

    public function sendConfirmAccountEmail(){
      $data=array(
        'email'=>"juan.gabriel.077@gmail.com",
        'password'=>"123456",
        'nombre'=>"juan esteban",
      );
      Mail::send('emails/confirm_account',$data,function($msj){
          $msj->subject('Confirmación de cuenta');
          $msj->to('juan.gabriel.077@gmail.com');
      });
      return "ok";
    }


    public function testCode(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $data=array();
      $colmena=new Colmena();
      $data['colmenas']=$colmena->getColmenasUsuario($id_cuenta_usuario);
      return view('test/test',$data);
    }
    public function getAcountIdUserAuth(){

      $user = auth()->user();
      $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
      return $cuenta->idcuenta_usuario;
    }

}
