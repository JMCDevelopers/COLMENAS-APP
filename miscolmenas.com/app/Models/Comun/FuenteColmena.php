<?php

namespace App\Models\Comun;

use Illuminate\Database\Eloquent\Model;

class FuenteColmena extends Model
{
  protected $table="fuente_abeja";
  protected $primaryKey = 'idfuente_abeja';

    protected $fillable = [
        'idfuente_abeja','nombre_fuente'
    ];
}
