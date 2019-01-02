<?php

namespace App\Models\Colmenas;

use Illuminate\Database\Eloquent\Model;
use DB;

class Colmena extends Model
{
  protected $table="colmenas";
  protected $primaryKey = 'idcolmenas';

  protected $fillable = [
      'idcolmenas','identificador_colmena', 'descripcion', 'num_marcos','created_at','updated_at','latitud','longitud','fuerza','otros_componentes',
      'apiario_idapiario','idreinas','tipo_colmena','procedencia_colmena',

  ];
  protected $hidden = [
      'remember_token'
  ];


  //obtenr colmenas de cuenta_usuario_idcuenta_usuario//obtener reinas instaladas
  public function getColmenasUsuario($id){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->leftJoin('reinas as T2','T2.idreinas','=','T0.idreinas')
          ->select('T0.idcolmenas','T2.idreinas','T2.identificador_reina','T1.idapiario','T0.descripcion','T0.identificador_colmena','T1.nombre_apiario','T0.created_at')
          ->where('T1.cuenta_usuario_idcuenta_usuario',$id)
          ->orderByRaw('T0.created_at desc')
          ->get();
  }


  //obtener colmenas de cuenta_usuario_idcuenta_usuario//obtener reinas instaladas
  public function getColmenasUsuarioEstadistica($id){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->leftJoin('reinas as T2','T2.idreinas','=','T0.idreinas')
          ->select('T0.idcolmenas','T2.idreinas','T2.identificador_reina','T1.idapiario','T0.descripcion','T0.identificador_colmena','T1.nombre_apiario','T0.created_at')
          ->where('T1.cuenta_usuario_idcuenta_usuario',$id)
          ->count();
  }

//obtener colmena por id
  public function getDetalleColmena($id){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->leftJoin('reinas as T2','T2.idreinas','=','T0.idreinas')
          ->select('T0.idcolmenas','T2.idreinas','T2.identificador_reina','T1.idapiario','T0.descripcion','T0.identificador_colmena','T1.nombre_apiario',
          'T0.created_at','T0.fuerza','T2.identificador_reina')
          ->where('T0.idcolmenas',$id)
          ->get();
  }
  // obtener material de  la colmena instalada
  public function getMaterialColmena($id){
    return $colmena = DB::table('material as T0')
          ->join('material_colmena as T1','T0.idmaterial','=','T1.idmaterial')
          ->join('colmenas as T2','T2.idcolmenas','=','T1.idcolmenas')
          ->select('T0.*','T1.*')
          ->where('T2.idcolmenas',$id)
          ->orderByRaw('T1.idmaterial_colmena desc')
          ->get();
  }

  //obtner Colmenas Por apiarios
  public function getAllColmenas($ID_CUENTA){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->join('provincia as T2','T2.idprovincia','=','T1.provincia_idprovincia')
          ->select('T0.identificador_colmena as colmena','T1.nombre_apiario as apiario','T2.nombre_provincia as provincia')
          ->where('T1.cuenta_usuario_idcuenta_usuario',$ID_CUENTA)
          ->orderByRaw('T0.created_at desc')
          ->get();
  }


  public function getColmenaEnferma($id_colmena){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->join('provincia as T2','T2.idprovincia','=','T1.provincia_idprovincia')
          ->join('inspeccion_colmena as T3','T3.idcolmenas','=','T0.idcolmenas')
          ->select('T3.enfermedad','T0.identificador_colmena as colmena','T1.nombre_apiario as apiario','T2.nombre_provincia as provincia','T3.observaciones','T3.descripcion_enfermedades as enfermedades')
          ->where('T0.idcolmenas',$id_colmena)
          ->orderByRaw('T3.idinspeccion_colmena desc limit 1')
          ->get();

  }

  public function getColmenasSinReina($ID_CUENTA){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->join('provincia as T2','T2.idprovincia','=','T1.provincia_idprovincia')
          ->select('T0.idReinasVenta','T0.idreinas','T0.identificador_colmena as colmena','T1.nombre_apiario as apiario','T2.nombre_provincia as provincia')
          ->where('T1.cuenta_usuario_idcuenta_usuario',$ID_CUENTA)
          ->orderByRaw('T0.identificador_colmena')
          ->get();

  }

  // reporte reina colmenas
  public function getColmenaReinaVieja($ID_CUENTA){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->join('provincia as T2','T2.idprovincia','=','T1.provincia_idprovincia')
          ->join('reinas  as T3','T3.idreinas','=','T0.idreinas')
          ->select('T3.fecha_nacimiento','T0.identificador_colmena as colmena','T1.nombre_apiario as apiario','T2.nombre_provincia as provincia')
          ->where('T1.cuenta_usuario_idcuenta_usuario',$ID_CUENTA)
          ->get();

  }
  // reporte reina colmenas venta
  public function getColmenaReinaViejaVenta($ID_CUENTA){
    return $colmena = DB::table('colmenas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.apiario_idapiario')
          ->join('provincia as T2','T2.idprovincia','=','T1.provincia_idprovincia')
          ->join('reinasventa  as T3','T3.idReinasVenta','=','T0.idReinasVenta')
          ->select('T3.fecha_nacimiento','T0.identificador_colmena as colmena','T1.nombre_apiario as apiario','T2.nombre_provincia as provincia')
          ->where('T1.cuenta_usuario_idcuenta_usuario',$ID_CUENTA)
          ->get();

  }

  // cosechas
  public function getCosechasProducto($ID_CUENTA,$producto,$inicio,$fin){
    return $colmena = DB::table('cosechas as T0')
          ->join('apiario as T1','T1.idapiario','=','T0.idapiario')
          ->join('provincia as T2','T2.idprovincia','=','T1.provincia_idprovincia')
          ->select('T1.nombre_apiario as apiario','T2.nombre_provincia as provincia','T0.cantidad','T0.producto','T0.unidad_medida','T0.fecha_cosecha')
          ->where('T1.cuenta_usuario_idcuenta_usuario',$ID_CUENTA)
          ->whereBetween('T0.fecha_cosecha',[$inicio,$fin])
          ->where(function($query) use($producto){
            if($producto!="empty")
            $query->where('T0.producto',$producto);
          })
          ->get();

  }

}
