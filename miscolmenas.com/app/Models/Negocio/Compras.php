<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use DB;
class Compras extends Model
{
  protected $table="Compras";
  protected $primaryKey = 'idCompras';
  protected $fillable = [
      'idCompras','created_at', 'updated_at', 'costo_total','tipo_documento','documento','tipo_pago','proveedor','telefono',
      'direccion','num_documento','idcuenta_usuario'
  ];
  protected $hidden = [
      'remember_token'
  ];
}
