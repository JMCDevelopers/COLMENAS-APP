<?php

namespace App\Models\Reina;

use Illuminate\Database\Eloquent\Model;
use DB;

class Reina extends Model
{
  protected $table="reinas";
  protected $primaryKey = 'idreinas';
  protected $fillable = [
      'idreinas','identificador_reina', 'descripcion', 'procedencia','aceptado','instalado','cortado','marcado','cuenta_usuario_idcuenta_usuario','raza_reina_idraza_reina'
  ];
  protected $hidden = [
      'idreinas','remember_token','cuenta_usuario_idcuenta_usuario'
  ];


  //obtener reinas no instaladas
  public function getReinas($id){
    return $apiario = DB::table('reinas')
          ->join('raza_reina', 'reinas.raza_reina_idraza_reina', '=', 'raza_reina.idraza_reina')
          ->select('*')
          ->where('reinas.instalado','=','NO')
          ->where('cuenta_usuario_idcuenta_usuario',$id)
          ->get();
  }

  //obtener reinas no instaladas
  public function getReinasEstadistica($id){
    return $apiario = DB::table('reinas')
          ->join('raza_reina', 'reinas.raza_reina_idraza_reina', '=', 'raza_reina.idraza_reina')
          ->select('*')
          ->where('cuenta_usuario_idcuenta_usuario',$id)
          ->count();
  }
  //obtener reinas reporte
  public function getReinasUser($id){
    return $apiario = DB::table('reinas')
          ->join('raza_reina', 'reinas.raza_reina_idraza_reina', '=', 'raza_reina.idraza_reina')
          ->select('*')
          ->where('cuenta_usuario_idcuenta_usuario',$id)
          ->get();
  }
  //obtener reinas instaladas
  public function getReinasInstaladas($id){
    return $apiario = DB::table('reinas')
          ->join('raza_reina', 'reinas.raza_reina_idraza_reina', '=', 'raza_reina.idraza_reina')
          ->select('*')
          ->where('reinas.instalado','=','SI')
          ->where('cuenta_usuario_idcuenta_usuario',$id)
          ->get();
  }
  //obtener reinas instaladas
  public function getReinasDetalle($id){
    return $apiario = DB::table('reinas')
          ->join('raza_reina', 'reinas.raza_reina_idraza_reina', '=', 'raza_reina.idraza_reina')
          ->select('*','reinas.descripcion as detalle')
          ->where('idreinas',$id)
          ->get();
  }

// obtiene reina colmena
  public function obtenerReinaColmena($id_colmena){
    return $apiario = DB::table('reinas as T0')
          ->join('colmenas as T1', 'T0.idreinas', '=', 'T1.idreinas')
          ->select('T0.*')
          ->where('T1.idcolmenas',$id_colmena)
          ->first();
  }

  // obtiene reina colmena venta
    public function obtenerReinaVentaColmena($id_colmena){
      return $apiario = DB::table('reinasventa as T0')
            ->join('colmenas as T1', 'T0.idReinasVenta', '=', 'T1.idReinasVenta')
            ->select('T0.*')
            ->where('T1.idcolmenas',$id_colmena)
            ->first();
    }


}
