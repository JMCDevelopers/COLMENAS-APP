<?php

namespace App\Models\Inspecciones;

use Illuminate\Database\Eloquent\Model;
use DB;

class Inspeccion extends Model
{
  protected $table="inspeccion_colmena";
  protected $primaryKey = 'idinspeccion_colmena';

  protected $fillable = [
      'idinspeccion_colmena','descripcion', 'fecha_inspeccion', 'created_at','reina','postura','cria','crias_nacidas',
      'fuerza_poblacion','temperamento_colmena','numero_marcos','observaciones','reservas_polen',
      'reservas_miel','albeolos','olor','material','idcolmenas','clima','descripcion_clima','enfermedad','descripcion_enfermedades',
      'imagen_inspeccion'
  ];
  protected $hidden = [
      'idinspeccion_colmena','remember_token'
  ];

  public function getInspeccionesUsuario($id,$idColmena){
    return $inspeccion=DB::table('apiario as T0')
            ->join('colmenas as T1','T0.idapiario','=','T1.apiario_idapiario')
            ->join('inspeccion_colmena as T2','T2.idcolmenas','=','T1.idcolmenas')
            ->where('T0.cuenta_usuario_idcuenta_usuario',$id)
            ->where('T1.idcolmenas',$idColmena)
            ->orderByRaw('T2.idinspeccion_colmena desc')
            ->get();
  }

  //inspeccion getReinasEstadistica

    public function getInspeccionesUsuarioReporte($id){
      return $inspeccion=DB::table('apiario as T0')
              ->join('colmenas as T1','T0.idapiario','=','T1.apiario_idapiario')
              ->join('inspeccion_colmena as T2','T2.idcolmenas','=','T1.idcolmenas')
              ->where('T0.cuenta_usuario_idcuenta_usuario',$id)
              ->orderByRaw('T2.idinspeccion_colmena desc')
              ->select('T2.fecha_inspeccion','T2.reina','T2.postura','T2.cria','T2.crias_nacidas','T2.fuerza_poblacion','T2.temperamento_colmena','T2.numero_marcos','T2.observaciones',
                'T2.reservas_polen','T2.reservas_miel','T1.identificador_colmena','T0.nombre_apiario')
              ->get();
    }

  public function getInspeccionesUsuarioEstadistica($id){
    return $inspeccion=DB::table('apiario as T0')
            ->join('colmenas as T1','T0.idapiario','=','T1.apiario_idapiario')
            ->join('inspeccion_colmena as T2','T2.idcolmenas','=','T1.idcolmenas')
            ->where('T0.cuenta_usuario_idcuenta_usuario',$id)
            ->Count();
  }
  //obtiene detalle por id inspeccion
  public function getInspeccion($id){
    return $inspeccion=DB::table('apiario as T0')
            ->join('colmenas as T1','T0.idapiario','=','T1.apiario_idapiario')
            ->join('inspeccion_colmena as T2','T2.idcolmenas','=','T1.idcolmenas')
            ->where('T2.idinspeccion_colmena',$id)
            ->get();
  }

  // obtiene inspecciones Colmena
  public function getInspeccionColmena($id){
    return $inspeccion=DB::table('apiario as T0')
            ->join('colmenas as T1','T0.idapiario','=','T1.apiario_idapiario')
            ->join('inspeccion_colmena as T2','T2.idcolmenas','=','T1.idcolmenas')
            ->where('T2.idcolmenas',$id)
            ->get()
            ->last();
  }

}
