<?php

namespace App\Models\Apiarios;

use Illuminate\Database\Eloquent\Model;
use DB;
class Apiario extends Model
{
    protected $table="apiario";
    protected $primaryKey = 'idapiario';
    protected $fillable = [
        'idapiario','nombre_apiario', 'descripcion', 'direccion','latitud','longitud','establecimiento','provincia_idprovincia','created_at'
    ];
    protected $hidden = [
        'idapiario','remember_token','cuenta_usuario_idcuenta_usuario'
    ];



    //funcion para obtener join de apiarios y provincias
    public function getApiarios($id){
      return $apiario = DB::table('apiario')
            ->join('provincia', 'apiario.provincia_idprovincia', '=', 'provincia.idprovincia')
            ->select('*')
            ->where('apiario.cuenta_usuario_idcuenta_usuario',$id)
            ->get();
    }

    //funcion para obtener join de apiarios
    public function getApiariosEstadistica($id){
      return $apiario = DB::table('apiario')
            ->join('provincia', 'apiario.provincia_idprovincia', '=', 'provincia.idprovincia')
            ->select('*')
            ->where('apiario.cuenta_usuario_idcuenta_usuario',$id)
            ->count();
    }
    //obtrener dsatos apiario por id
    public function getApiarioById($id){
      return $apiario = DB::table('apiario')
            ->join('provincia', 'apiario.provincia_idprovincia', '=', 'provincia.idprovincia')
            ->select('*')
            ->where('apiario.idapiario',$id)
            ->get();
    }
    //obtrener dsatos apiario por id
    public function getProvinciaById($id){
      return $apiario = DB::table('provincia')
            ->select('*')
            ->where('idprovincia',$id)
            ->get();
    }
}
