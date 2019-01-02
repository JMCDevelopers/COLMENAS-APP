<?php

namespace App\Models\Reina;

use Illuminate\Database\Eloquent\Model;

class ReinasVenta extends Model
{
  protected $table="reinasventa";
  protected $primaryKey = 'idReinasVenta';
  protected $fillable = [
      'idReinasVenta','raza', 'identificador', 'fecha_nacimiento','estado','historial','criadero','idCuentaUsuario'
  ];
  protected $hidden = [
      'remember_token'
      ];
}
