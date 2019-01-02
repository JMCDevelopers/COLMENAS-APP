<?php

namespace App\Models\Eventos;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
  protected $table="eventos";
  protected $primaryKey = 'ideventos';

  protected $fillable = [
      'ideventos','descripcion_evento', 'fecha_evento', 'created_at','updated_at','idcolmenas'
  ];
  protected $hidden = [
    'remember_token'
  ];
}
