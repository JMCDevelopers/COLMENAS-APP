<?php

namespace App\Models\Inspecciones;

use Illuminate\Database\Eloquent\Model;

class AlimentacionColmena extends Model
{
  protected $table="alimentacion_colmena";
  protected $primaryKey = 'idalimentacion_colmena';
  protected $fillable = [
      'idalimentacion_colmena','created_at', 'nombre_alimento', 'idinspeccion_colmena'
  ];
  protected $hidden = [
      'idalimentacion_colmena','remember_token'
  ];
}
