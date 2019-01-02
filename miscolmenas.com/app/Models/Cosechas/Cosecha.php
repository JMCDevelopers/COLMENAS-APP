<?php

namespace App\Models\Cosechas;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cosecha extends Model
{
  protected $table="cosechas";
  protected $primaryKey = 'idcosechas';
  protected $fillable = [
      'idcosechas','descripcion', 'fecha_cosecha', 'cantidad','unidad_medida','producto','colmenas_cosechadas','url_imagenl','idapiario','created_at'
  ];
  protected $hidden = [
      'idcosechas','remember_token'
  ];

  public function getDetalleCosecha($id){
    return $cosecha=DB::table('cosechas as T0')
            ->join('apiario as T1','T1.idapiario','=','T0.idapiario')
            ->where('T0.idcosechas',$id)
            ->get();
  }

  //reporte cosechas
  public function getCosechasReporte($id){
    return $cosecha=DB::table('cosechas as T0')
            ->join('apiario as T1','T1.idapiario','=','T0.idapiario')
            ->where('T1.cuenta_usuario_idcuenta_usuario',$id)
            ->orderByRaw('T0.created_at desc')
            ->select('T0.idcosechas','T0.descripcion','T0.producto','T0.unidad_medida','T0.cantidad','T1.nombre_apiario','T0.fecha_cosecha')
            ->get();
  }

  public function getCosechasPorMes($mes,$id){
    return $cosecha=DB::table('cosechas as T0')
            ->join('apiario as T1','T1.idapiario','=','T0.idapiario')
            ->where('T1.cuenta_usuario_idcuenta_usuario',$id)
            ->where('T0.created_at','like',''.$mes.'%')
            ->count();
  }
  public function getCosechasEstadistica($id){
    return $cosecha=DB::table('cosechas as T0')
            ->join('apiario as T1','T1.idapiario','=','T0.idapiario')
            ->where('T1.cuenta_usuario_idcuenta_usuario',$id)
            ->count();
  }
}
