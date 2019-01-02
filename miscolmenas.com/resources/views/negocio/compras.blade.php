@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Compras</li>
    </ol>
  </div>

  <!-- DETALLE DE INSPECCION -->
  <div class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" id="detalle_venta" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="" id="titulo"> DETALLE DE VENTA</h2>
        </div>
        <div class="modal-body">
          <div class="box">
            <h4 class="box-title">Documento</h4>
            <div class="box box-info">
            <div class="box-body">
              <table class="table">
                <tr>
                  <th>Tipo de documento:</th>
                  <td id="tipo_documento_detalle"></td>
                  <th>Número de Documento:</th>
                  <td id="documento_detalle"></td>
                  <th>Pago</th>
                  <td id="pago_detalle"></td>
                </tr>
              </table>
            </div>
          </div>
          </div>
          <div class="box">
            <h4 class="box-title">Provedor</h4>
            <div class="box-body">
              <table class="table">
                <tr>
                  <th>Provedor:</th>
                  <td id="provedor_detalle"></td>
                  <th>Cedula/Ruc:</th>
                  <td id="cedula_detalle"></td>
                  <th>Telefono:</th>
                  <td id="telefono_detalle"></td>
                </tr>
                <tr>
                  <th>Direción:</th>
                  <td id="direccion_detalle"></td>
                </tr>
              </table>
            </div>
          </div>

          <div class="box">
            <h4 class="box-title">Detalle</h4>
            <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Costo</th>
                <th>Cantidad</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="table_detalle">

            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <th>TOTAL VENTA: </th>
                <td> <span class="text-danger" id="total_ven"></span> </td>
              </tr>
            </tfoot>

          </table>
        </div>
      </div>

          <div class="modal-footer">
            <div class="box">
              <button type="button" onclick="cerrarDetalle();" class="btn btn-primary" name="button">CERRAR</button>
            </div>
          </div>
          </div>


      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <!-- nueva venta -->
  <div class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" id="nueva_compra" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="" id="titulo"> INGRESAR COMPRA</h2>
        </div>
        <div class="modal-body" id="modal-body">

          <div class="box box-info">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">

                <div class="box">
                  <h4 class="box-title">Documento</h4>
                  <div class="box-body">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <input type="hidden" name="" id="id_cuenta" value="{{$id_cuenta_usuario}}">
                          <label for="">TIPO DOCUMENTO</label>
                            <select class="form-control" id="tipo_documento" name="">
                              <option value="FACTURA">FACTURA</option>
                              <option value="NOTA DE VENTA">NOTA DE VENTA</option>
                              <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">NUMERO DOCUMENTO</label>
                          <input type="text" class="form-control" id="documento" name="" placeholder="Ingrese número de documento 000 0001" value="">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">TIPO PAGO</label>
                            <select class="form-control" id="tipo_pago" name="">
                              <option value="EFECTIVO">EFECTIVO</option>
                              <option value="ARJETA DE DEBITO">TARJETA DE DEBITO</option>
                              <option value="TARJETA DE CREDITO">TARJETA DE CREDITO</option>
                              <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                      </div>
                </div>
              </div>


              <div class="box">
                <h4 class="box-title"> Datos Provedor</h4>
                  <div class="box-body">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="">PROVEDOR</label>
                        <input class="form-control" type="text" id="provedor" placeholder="Ingrese nombre provedor" value="">
                      </div>
                    </div>
                     <div class="col-lg-3">
                       <div class="form-group">
                         <label for="">CEDULA/RUC PROVEDOR</label>
                         <input class="form-control" type="text" id="num_documento" placeholder="Ingrese cedula/ruc" name="" value="">
                       </div>
                     </div>

                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="">TELEFONO PROVEDOR</label>
                        <input  class="form-control" id="telefono" placeholder="Ingrese un telefono" type="text" name="" value="">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="">DIRECCION PROVEDOR</label>
                        <input class="form-control" id="direccion" type="text" placeholder="INgrese una dirección" name="" value="">
                      </div>
                    </div>

                </div>
              </div>

                <div class="box">
                  <h4 class="box-title"> Items Compra</h4>
                    <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Producto</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="producto" placeholder="Nombre Producto">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Costo</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="costo" placeholder="Precio Producto">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Cantidad</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="cantidad" placeholder="Cantidad">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary btn-xs" onclick="generarItemsCompra();"  name="button">Ingresar Item</button>
                    </div>
                  </div>
                </div>
              </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="box" id="">
                  <table class="table">
                    <thead>
                      <tr>

                        <th>Producto</th>
                        <th>Costo</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody id="contenedor_compra">

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>TOTAL: </th>
                        <td><span id="total" class="text-danger"></span> </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>


        <div class="modal-footer">
          <div class="box">
            <button type="button" onclick="generarCompra();" class="btn btn-warning btn-block" name="button">GUARDAR COMPRA</button>
          </div>
          <div class="box">
            <button type="button" onclick="cancelarCompra();" class="btn btn-danger btn-block" name="button">CANCELAR</button>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>

  <div class="box">
    <div class="box-body">
      <div class="col-lg-6">
        <button type="button" class="btn btn-success btn-block"  onclick="nuevaCompra();" name="button" >Ingresar Compra</button>
      </div>
    </div>



  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Ventas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-body">
          <table class="table" id="tabla_compras">
            <thead>
              <tr>
                <th>#</th>
                <th>PROVEDOR</th>
                <th>TIPO DOCUMENTO</th>
                <th>DOCUMENTO</th>
                <th>TOTAL VENTA</th>
                <th>FECHA COMPRA</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
            <tbody>
              @php
                $cont=0;
              @endphp
              @foreach ($compras as $key => $value)
                @php
                  $cont++;
                @endphp
                <tr>
                  <td>{{$cont}}</td>
                  <td>{{$value->proveedor}}</td>
                  <td>{{$value->tipo_documento}}</td>
                  <td>{{$value->documento}}</td>
                  <td>{{$value->costo_total}}</td>
                  <td>{{$value->created_at}}</td>
                  <td>
                    <button class="btn btn-info btn-xs" onclick="verDetalleVenta({{$value->idCompras}});"> VER DETALLE</button>
                    <button class="btn btn-danger btn-xs" onclick="eliminarCompra({{$value->idCompras}})"> ELIMINAR</button>
                   </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  <script src="{{ asset('js/compras.js') }}" defer></script>
@endsection
