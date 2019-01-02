<?php

namespace App\Models\Inspecciones;

use Illuminate\Database\Eloquent\Model;

class CondicionesColmena extends Model
{
  protected $table="condiciones_colmena";
  protected $primaryKey = 'idcondiciones_colmena';
  protected $fillable = [
      'idcondiciones_colmena','created_at', 'nombre_condicion', 'idinspeccion_colmena'
  ];
  protected $hidden = [
      'idcondiciones_colmena','remember_token'
  ];
}
