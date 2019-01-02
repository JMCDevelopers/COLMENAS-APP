<?php

namespace App\Models\Comun;

use Illuminate\Database\Eloquent\Model;

class TipoColmena extends Model
{
  protected $table="tipo_colmena";
  protected $primaryKey = 'idtipo_colmena';

  protected $fillable = [
      'idtipo_colmena','nombre_tipo'
  ];
}
