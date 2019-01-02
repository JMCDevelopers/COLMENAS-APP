<?php

namespace App\Models\Inspecciones;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
  protected $table="enfermedades";
  protected $primaryKey = 'idenfermedades';
  protected $fillable = [
      'idenfermedades','created_at', 'nombre_enfermedad', 'idinspeccion_colmena'
  ];
  protected $hidden = [
      'idenfermedades','remember_token'
  ];
}
