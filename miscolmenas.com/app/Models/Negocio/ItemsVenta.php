<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use DB;
class ItemsVenta extends Model
{
  protected $table="items_ventas";
  protected $primaryKey = 'iditems_ventas';
  protected $fillable = [
      'iditems_ventas','idVentas','created_at', 'updated_at', 'item','costo','cantidad','impuesto','total'
  ];
  protected $hidden = [
      'remember_token'
  ];
}
