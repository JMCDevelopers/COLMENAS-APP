@extends('layouts/dashboard')
@section('contenido')

  <!-- DETALLE DE COSECHA -->
  <div class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" id="modal_detalle_cosecha" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="" id="titulo">DETALLE DE COSECHA</h2>
        </div>
        <div class="modal-body" id="modal-body">
          <div class="panel panel-primary">
              <div class="panel-heading">INFORMACIÓN GENERAL</div>
              <div class="panel-body">
            <div id="pd_procesos" class="table">
              <div class="form-group">
                  <div class="row">
                    <table class="">
                      <tr>
                        <th>Fecha de cosecha:</th>
                        <td><span id="fecha_cosecha"> sjjs</span></td>
                      </tr>
                      <tr>
                        <th>Producto: </th>
                        <td><span id="producto"> sjjs</span></td>
                      </tr>
                      <tr>
                        <th>Descripción: </th>
                        <td><span id="descripcion"> sjjs</span></td>
                      </tr>
                      <tr>
                        <th>Cantidad: </th>
                        <td><span id="cantidad"> sjjs</span></td>
                      </tr>
                      <tr>
                        <th>Unidad: </th>
                        <td><span id="unidad"> sjjs</span></td>
                      </tr>
                      <tr>
                        <th>Apiario: </th>
                        <td><span class="text-danger" id="apiario_detalle">sjjs</span></td>
                      </tr>
                      <tr>
                        <th>Direccion apiario: </th>
                        <td><span class="text-danger" id="direccion_apiario">sjjs</span></td>
                      </tr>
                      <tr>
                        <th>Descripción apiario:   </th>
                        <td><span class="text-danger" id="descripcion_apiario">sjjs</span></td>
                      </tr>
                    </table>
                </div>
              </div>
            </div>
              </div>
          </div>


          <div class="panel panel-primary">
              <div class="panel-heading">IMAGEN COSECHA</div>
              <div class="panel-body">
            <div id="pd_procesos" class="table table-responsive">
              <div class="form-group">
                <center>
                  <img width="500px"  height="500px" id="imagen_cosecha"/>
                </center>
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

  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Listas de Cosechas</li>
    </ol>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Accciones</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-body">
          <div class="form-group col-lg-3">
            <a type="button" href="{{route('cosecha')}}" name="button" class="btn btn-warning btn-block">Ingresar Nueva Cosecha</a>
          </div>
        </div>
      </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Mis Cosechas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-body">
            <div class="table-responsive" style="font-size:11px; text-align:center; cursor: pointer" >
            <table class="table table-bordered table-hover" id="tabla_cosechas">
              <thead>
                <th>#</th>
                <th>Producto</th>
                <th>Descripción Cosecha</th>
                <th>Cantidad</th>
                <th>Unidad Medida</th>
                <th>Fecha de cosecha</th>
                <th>Acciones</th>
              </thead>
              <tbody>
                @php
                  $contador=0;
                @endphp
                @foreach ($cosechas as $key => $value)
                  @php
                    $contador++;
                  @endphp
                  <tr>
                    <td>{{$contador}}</td>
                    <td>{{$value->producto}}</td>
                    <td>{{$value->descripcion}}</td>
                    <td>{{$value->cantidad}}</td>
                    <td>{{$value->unidad_medida}}</td>
                    <td>{{$value->fecha_cosecha}}</td>
                    <td>
                    <button type="button" onclick="EditarCosecha({{$value->idcosechas}});" class="btn btn-info btn-xs" name="button"><i class="	glyphicon glyphicon-pencil"></i> </button>
                    <button type="button" onclick="EliminarCosecha({{$value->idcosechas}})" class="btn btn-danger btn-xs" name="button"><i class="glyphicon glyphicon-trash"></i> </button>
                    <button type="button" onclick="detalleCosecha({{$value->idcosechas}})" class="btn btn-warning btn-xs" name="button"><i class="glyphicon glyphicon-eye-open"></i>Ver Detalle</button>
                  </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

  <script src="{{ asset('js/cosechas.js') }}" defer></script>
@endsection
