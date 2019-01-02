<?php

namespace App\Models\Inspecciones;

use Illuminate\Database\Eloquent\Model;

class ImagenInspeccion extends Model
{
  protected $table="imagenes_inspeccion";
  protected $primaryKey = 'idimagenes_inspeccion';
  protected $fillable = [
      'idimagenes_inspeccion','descricpion_img', 'url_imagen_inspeccion', 'idinspeccion_colmena'
  ];
  protected $hidden = [
      'idimagenes_inspeccion','remember_token'
  ];
}
