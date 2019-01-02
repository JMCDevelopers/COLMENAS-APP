<?php

namespace App\Models\Apiarios;

use Illuminate\Database\Eloquent\Model;
use DB;

class InspeccionApiario extends Model
{
  protected $table="inspeccion_apiario";
  protected $primaryKey = 'idinspeccion_apiario';
  protected $fillable = [
      'idinspeccion_apiario','detalle_inspeccion', 'fecha_inspeccion', 'created_at'
  ];
  protected $hidden = [
      'remember_token'
  ];


  // obtiene inspecciones Colmena
  public function getInspeccionApiario($id){
    return $inspeccion=DB::table('apiario as T0')
            ->join('inspeccion_apiario as T1','T1.idapiario','=','T0.idapiario')
            ->where('T1.idapiario',$id)
            ->get()
            ->last();
  }
}
