<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use DB;
class Ventas extends Model
{
  protected $table="Ventas";
  protected $primaryKey = 'idVentas';
  protected $fillable = [
      'idVentas','created_at', 'updated_at', 'tipo','tipo_documento','costo_total','documento','tipo_pago','idcuenta_usuario',
      'cliente','num_documento','telefono','direccion','total_impuesto'
  ];
  protected $hidden = [
      'remember_token'
  ];
}
