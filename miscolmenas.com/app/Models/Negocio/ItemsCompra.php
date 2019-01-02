<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class ItemsCompra extends Model
{
  protected $table="items_compras";
  protected $primaryKey = 'iditems_compras';
  protected $fillable = [
      'iditems_compras','item','created_at', 'updated_at','costo','cantidad','impuesto','total','idCompras'
  ];
  protected $hidden = [
      'remember_token'
  ];
}
