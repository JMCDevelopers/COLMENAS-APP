<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Dashboard\Cuenta;
  Use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user=User::create([
            'nombre' => $data['name'],
            'direccion' => $data['direccion'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $id=$user->id;
        $cuenta=new Cuenta();
        $cuenta->estado="1";
        $cuenta->cuenta_idcuenta=1;
        $cuenta->users_id=$id;
        $cuenta->save();
      //  $this->sendConfirmAccountEmail($data['name'],$data['email'],$data['password']);
        return $user;
    }

    /*
    private function sendConfirmAccountEmail($nombre,$email,$password){
      $data=array(
        'email'=>,$email,
        'password'=>$password,
        'nombre'=>$nombre,
      );
      Mail::send('emails/confirm_account',$data,function($msj){
          $msj->subject('Confirmación de cuenta');
            $msj->to('juan.gabriel.077@gmail.com');
      });
      return true;
    }*/
}
