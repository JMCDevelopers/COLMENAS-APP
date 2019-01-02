@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Reportes y estadistica</a></li>
      <li class="active">Colmenas/Apiarios</li>
    </ol>
  </div>
<div class="panel-body col-md-12">
  <div class="box box-success">
    <div class="box-body">
      <div class="panel">
        <div class="row">
          <div class="form-group col-lg-6">
            <label for="inputPassword3" class="col-sm-2 control-label">COLMENAS:</label>
            <div class="col-sm-8">
              <select class="form-control" id="tipo_reporte_colmena" name="">
                <option value="">---SELECCIONE---</option>
                <option value="1">ENFERMAS</option>
                <option value="2">SIN REINA</option>
                <option value="3">REINAS VIEJAS</option>
                <option value="4">TODAS</option>
              </select>
            </div>
          </div>


          <div class="form-group col-lg-6">
            <div class="col-sm-6">
              <button onclick="generarReporteColmenas()" type="button"class="btn btn-success"  name="button">Generar Reporte</button>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- BAR CHART -->
        <div class="box box-success" id="body_reporte">
          <div class="box-header with-border">
            <h3 class="box-title" id="nombre_reporte"></h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table id="tabla_reporte" border="1" class="table">
              <thead>
                <tr>
                  <th>COLMENA</th>
                  <th>APIARIO</th>
                  <th>PROVINCIA</th>
                  <th>OBSERVACION</th>
                  <th>DETALLE ENFERMEDADES</th>
                </tr>
              </thead>
              <tbody id="detalle_reporte_colmenas">

              </tbody>
            </table>
            <span id="num_registros" class="text-danger"></span>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box box-success" style="display:none;" id="imprimir">
          <div class="box-body">
            <div class="chart">
              <button class="btn btn-info" onclick="imprimirReporteColmenas()" type="button" name="button">imprimir Reporte</button>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
</div>
<script src="{{ asset('js/reporte_colmenas_apiarios.js') }}" defer></script>
@endsection
