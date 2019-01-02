<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Negocio\Ventas;
use App\Models\Negocio\Compras;
use App\Models\Tareas\Tarea;
use App\Models\Dashboard\Cuenta;
use App\Models\Negocio\ItemsVenta;
use App\Models\Negocio\ItemsCompra;

class NegocioController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public function ventas(){
    try {
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $tarea=new Tarea();
      $venta=new Ventas();
      $result=$venta->where('idcuenta_usuario',$id_cuenta_usuario)->orderByRaw('idVentas desc')->get();
      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['id_cuenta_usuario']=$id_cuenta_usuario;
      $data['ventas']=$result;
      return view('negocio/ventas',$data);
      //return view();
    } catch (\Exception $e) {
      response()->json("Error_ ".$e);
    }

  }
  public function compras(){
    try {
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $tarea=new Tarea();
      $data=array();
      $user = auth()->user();
      $compras=new Compras();
      $result=$compras->where('idcuenta_usuario',$id_cuenta_usuario)->orderByRaw('idCompras desc')->get();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      $data['id_cuenta_usuario']=$id_cuenta_usuario;
      $data['compras']=$result;
      return view('negocio/compras',$data);
      //return view();
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }
  //obtener el id de cuenta de usuario loggeado
  public function getAcountIdUserAuth(){
    $user = auth()->user();
    $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
    return $cuenta->idcuenta_usuario;
  }

  // insertar venta
  public function insertarVenta(Request $request){
    try {
      //$input=$request->all();
      $ventas=new Ventas();
      $ventas->costo_total=$request->costo_total;
      $ventas->tipo_documento=$request->tipo_documento;
      $ventas->documento=$request->documento;
      $ventas->tipo_pago=$request->tipo_pago;
      $ventas->cliente=$request->cliente;
      $ventas->num_documento=$request->num_documento;
      $ventas->telefono=$request->telefono;
      $ventas->direccion=$request->direccion;
      $ventas->idcuenta_usuario=$request->idcuenta_usuario;
      $ventas->total_impuestos=$request->total_impuesto;
      $ventas->save();
      $id=$ventas->idVentas;
      $items=$request->items;
      for ($i=0; $i <count($items) ; $i++) {
          $item=new ItemsVenta();
          $item->item=$items[$i]["producto"];
          $item->costo=$items[$i]["costo"];
          $item->cantidad=$items[$i]["cantidad"];
          $item->impuesto=$items[$i]["impuesto"];
          $item->total=$items[$i]["total"];
          $item->idVentas=$id;
          $item->save();
      }
      return response()->json(true);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }
// crear compra
public function ingresarCompra(Request $request){
  try {
    $compra=new Compras();
    $compra->costo_total=$request->costo_total;
    $compra->tipo_documento=$request->tipo_documento;
    $compra->documento=$request->documento;
    $compra->tipo_pago=$request->tipo_pago;
    $compra->proveedor=$request->provedor;
    $compra->num_documento=$request->num_documento;
    $compra->telefono=$request->telefono;
    $compra->direccion=$request->direccion;
    $compra->idcuenta_usuario=$request->idcuenta_usuario;
    $compra->save();
    $id=$compra->idCompras;
    $items=$request->items;
    for ($i=0; $i <count($items) ; $i++) {
        $item=new ItemsCompra();
        $item->item=$items[$i]["producto"];
        $item->costo=$items[$i]["costo"];
        $item->cantidad=$items[$i]["cantidad"];
        $item->total=$items[$i]["total"];
        $item->idCompras=$id;
        $item->save();
    }
    return response()->json(true);
  } catch (\Exception $e) {
    return response()->json("Error_ ".$e);
  }

}
  // obtener venta
  public function obtenerVenta(Request $request){
    try {
      $venta=new Ventas();
      $result=$venta->where('idVentas',$request->idVentas)->first();
      return response()->json($result);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }
  }

  // obtener compras
  public function obtenerCompra(Request $request){
    try {
      $compra=new Compras();
      $result=$compra->where('idCompras',$request->idCompras)->first();
      return response()->json($result);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }
  // obtener items venta
  public function obtenerItemsVenta(Request $request){
    try {
      $items=new ItemsVenta();
      $res=$items->where('idVentas',$request->idVentas)->get();
      return response()->json($res);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }
// obtner items compras
public function obtenerItemsCompra(Request $request){
  try {
    $items=new ItemsCompra();
    $res=$items->where('idCompras',$request->idCompras)->get();
    return response()->json($res);
  } catch (\Exception $e) {
    return response()->json("Error_ ".$e);
  }

}
  // eliminar venta
  public function eliminarVenta(Request $request){
    try {
        $venta=Ventas::find($request->idVentas);
        $venta->delete();
        return response()->json(true);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }

  // eliminar compra
  public function eliminarCompra(Request $request){
    try {
      $compra=Compras::find($request->idCompras);
      $res=$compra->delete();
      return response()->json($res);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }

  // reportes de Negocio
  public function reportes(){
    try {
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $tarea=new Tarea();
      $venta=new Ventas();
      $result=$venta->where('idcuenta_usuario',$id_cuenta_usuario)->orderByRaw('idVentas desc')->get();
      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      return view('negocio/reportes_negocio',$data);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }


  // generar reporte de NEGOCIO
  public function generarReporte(Request $request){
    try {
      $inicio=$request->desde;
      $fin=$request->hasta;
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $ventas= new Ventas();
      $sum_ventas=$ventas->where('idcuenta_usuario',$id_cuenta_usuario)->whereBetween('created_at',[$inicio,$fin])->sum('costo_total');
      $compras= new Compras();
      $sum_compras=$compras->where('idcuenta_usuario',$id_cuenta_usuario)->whereBetween('created_at',[$inicio,$fin])->sum('costo_total');
      if(is_null($sum_ventas)){
        $sum_ventas=0;
      }
      if(is_null($sum_compras)){
        $sum_compras=0;
      }
      $ganancias=$sum_ventas-$sum_compras;
      $data=array();
      $data["ventas"]=$sum_ventas;
      $data["compras"]=$sum_compras;
      $data["ganancias"]=$ganancias;
      return response()->json($data);
    } catch (\Exception $e) {
      return response()->json("Error_ ".$e);
    }

  }

  
}
