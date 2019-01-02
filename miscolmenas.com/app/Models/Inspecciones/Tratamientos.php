<?php

namespace App\Models\Inspecciones;

use Illuminate\Database\Eloquent\Model;

class Tratamientos extends Model
{
  protected $table="tratamientos";
  protected $primaryKey = 'idtratamientos';

  protected $fillable = [
      'idtratamientos','created_at', 'nombre_tratamiento', 'idinspeccion_colmena'
  ];
  protected $hidden = [
      'idtratamientos','remember_token'
  ];
}
