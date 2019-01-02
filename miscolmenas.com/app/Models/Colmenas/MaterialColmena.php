<?php

namespace App\Models\Colmenas;

use Illuminate\Database\Eloquent\Model;

class MaterialColmena extends Model
{
  protected $table="material_colmena";
  protected $primaryKey = 'idmaterial_colmena';
  protected $fillable = [
      'idmaterial_colmena','created_at', 'idmaterial', 'idcolmenas'
  ];
  protected $hidden = [
      'idmaterial_colmena','remember_token'
  ];
}
