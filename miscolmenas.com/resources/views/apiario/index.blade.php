@extends('layouts/dashboard')
@section('contenido')



  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Apiarios</li>
    </ol>
  </div>


  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Nuevo Apiario</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ingrese la información del nuevo apiario</h4>
              </div>
              <div class="modal-body">
                <form class="" id="form_apiario" action="{{route('crear_apiario')}}" method="post">
                  {{ csrf_field() }}

                    <div class="form-group {{$errors->has('nombre_apiario') ? 'has-error' : ''}}">
                      <label for="nombre_apiario">Nombre Apiario</label>
                      <input type="text" class="form-control" id="identificador" name="nombre_apiario" value=""  placeholder="Nombre o Identificador">
                      {!!$errors->first('nombre_apiario','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group  {{$errors->has('direccion') ? 'has-error' : ''}}">
                      <label for="direccion">Dirección</label>
                      <input type="text" id="direccion" class="form-control" name="direccion" value=""  placeholder="Direccion apiario">
                      {!!$errors->first('direccion','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group  {{$errors->has('provincia') ? 'has-error' : ''}}">
                      <label for="provincia">Provincia</label>
                      <select class="form-control" name="provincia" id="provincia">
                        <option value="">Provincias</option>
                        @foreach ($provincias as $key => $value)
                          <option value="{{$value->idprovincia}}">{{$value->nombre_provincia}}</option>
                        @endforeach
                      </select>
                      {!!$errors->first('provincia','<span class="help-block">:message</span>')!!}
                    </div>

                    <div class="form-group  {{$errors->has('descripcion') ? 'has-error' : ''}}">
                      <label for="descripcion">Descripción</label>
                      <textarea  class="form-control" id="descripcion" name="descripcion"  placeholder="Descripción apiario"></textarea>
                      {!!$errors->first('descripcion','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('establecimiento') ? 'has-error' : ''}}">
                      <label for="establecimiento">Establecimiento</label>
                      <select class="form-control" name="establecimiento" id="establecimiento">
                        <option value="Propio">Propio</option>
                        <option value="Arrendado">Arrendado</option>
                      </select>
                      {!!$errors->first('establecimiento','<span class="help-block">:message</span>')!!}
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="guardarApiario();" class="btn btn-primary">Guardar Apiario</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
                CREAR NUEVO APIARIO
          </button>

        </div>
      </div>

      <!-- Modal Editar -->
      <div id="modal_eliminar" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background:#dd4b39;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Alerta MCL</h4>
            </div>
            <div class="modal-body">
              <p>Esta seguro de eliminar el apiario? SI, click Eliminar | NO, Cancelar</p>
              <form class="" id="frm_eliminar" action="{{route('eliminar_apiario')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="id_apiario"  name="idapiario" value="">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="EliminarApiario();" >Eliminar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>

        </div>
      </div>
      <!--fin modal-->
      <!--FIN MODAL FORMATO IMPRESION-->
      <!-- DETALLE DE PEDIDO -->
      <div class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" id="modal_detalle_apiario" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="" id="titulo"></h2>
            </div>
            <div class="modal-body" id="modal-body">
              <div class="table table-responsive">
                <table class="table table-responsive table-hover table-condensed" style="border:none;color:#000;">
                  <tr>
                    <td style="font-weight:bold">
                      FECHA DE CREACION:
                    </td>
                    <td>
                      <div id="fecha_creacion"  style="text-align: left"></div>
                    </td>
                    <td style="font-weight:bold">
                      NÚMERO DE COLMENAS:
                    </td>
                    <td>
                      <div id="numero_colmenas"  style="text-align: left"></div>
                    </td>
                    <td style="font-weight:bold">
                      PROVINCIA:
                    </td>
                    <td>
                      <div id="provincia"  style="text-align: left"></div>
                    </td>
                  </tr>
                </table>
              </div>
              <!--
              <div class="panel panel-info">
                <div class="panel-heading">UBICACIÓN EN EL MAPA</div>
                <div class="panel-body">
                  <iframe id="mapa_apiario" style="width: 100%; height: 300px;"  class="table table-responsive"></iframe>
                </div>
              </div>-->
              <div class="panel panel-info">
                <div class="panel-heading">INSPECCION</div>
                <div class="panel-body" id="contenedor_detalle_inspeccion">
                  <div class="table table-responsive" id="contenedors">
                    <div class="form-group">
                      <!-- ./col -->
                      <div class="col-md-12">
                        <div class="box box-solid">
                          <div class="box-header with-border">
                            <i class="fa fa-text-width"></i>

                            <h3 class="box-title">Detalle ultima Inspección</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <dl class="dl-horizontal">
                              <dt>Fecha Inspeccion: </dt>
                              <dd id="fecha_inspeccion"></dd>
                              <dd></dd>
                              <dt>Descripción: </dt>
                              <dd id="detalle_inspeccion"> </dd>

                            </dl>
                          </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                      </div>
                    </div>

                      <div class="row" id="contenedor_imagen_inspeccion">
                        imagen
                      </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Apiarios</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="font-size:11px; text-align:center; cursor: pointer" id="contenedor_tabla">

            </div>
          </div>
          <
          <script src="{{ asset('js/apiarios.js') }}" defer></script>
        @endsection
