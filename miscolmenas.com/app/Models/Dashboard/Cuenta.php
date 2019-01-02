<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cuenta extends Model
{
  protected $table="cuenta_usuario";
  protected $primaryKey = 'idcuenta_usuario';
  protected $fillable = [
      'idcuenta_usuario','estado','cuenta_idcuenta','users_id'
  ];

  //obtener permisos cuenta
  public function getUserAccount($id){
    return $apiario = DB::table('cuenta as T0')
          ->join('cuenta_usuario as T1', 'T1.cuenta_idcuenta', '=', 'T0.idcuenta')
          ->join('users as T2', 'T2.id', '=', 'T1.users_id')
          ->select('*')
          ->where('T1.users_id',$id)
          ->get();
  }

}
