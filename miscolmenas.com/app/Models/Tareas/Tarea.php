<?php

namespace App\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tarea extends Model
{
  protected $table="tareas";
  protected $primaryKey = 'idtareas';
  protected $fillable = [
      'created_at', 'descripcion_tarea', 'fecha_realizacion','idcuenta_usuario','tipo','estado','title','start','color'
  ];
  protected $hidden = [
      'idtareas','remember_token','idcuenta_usuario'
  ];

  // obtiene inspecciones Colmena
  public function getTareasPendientes($id){
    return $tareas=DB::table('tareas')
            ->where('idcuenta_usuario',$id)
            ->where('estado','0')
            ->get();
  }
  // obtiene inspecciones Colmena
  public function getTareasEstadisticas($id){
    return $tareas=DB::table('tareas')
            ->where('idcuenta_usuario',$id)
            ->count();
  }
}
