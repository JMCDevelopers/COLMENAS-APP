@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Reportes y estadistica</a></li>
      <li class="active">Cosechas/Insepecciones</li>
    </ol>
  </div>

  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Seleccione un rango de fecha</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="form-group col-lg-4">
        <label for="inputPassword3" class="col-sm-2 control-label">DESDE:</label>
        <div class="col-sm-8">
          <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="fecha_desde" >
        </div>
      </div>
      <div class="form-group col-lg-4">
        <label for="inputPassword3" class="col-sm-2 control-label">HASTA:</label>
        <div class="col-sm-8">
          <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="fecha_hasta">
        </div>
      </div>
      <div class="form-group col-lg-4">
        <label for="inputPassword3" class="col-sm-3 control-label">PRODUCTO:</label>
        <div class="col-sm-8">
          <select class="form-control" id="producto" name="">
            <option value="empty">---SELECCIONE---</option>
            <option value="Miel">MIEL</option>
            <option value="Polen">POLEN</option>
            <option value="Propoleo">PROPOLEO</option>
            <option value="Cera">CERA</option>
            <option value="empty">TODO</option>
          </select>
        </div>
      </div>
      <div class="form-group col-lg-4">
        <div class="col-sm-6">
          <button onclick="generarReporteCosechas()" type="button"class="btn btn-success"  name="button">Generar Reporte</button>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>


<div class="panel-body col-md-12">
  <!-- BAR CHART -->
        <div class="box box-success" id="body_reporte">
          <div class="box-header with-border">
            <h3 class="box-title" id="titulo_reporte">REPORTE DE COSECHAS</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <table id="" border="1" class="table">
                <thead>
                  <tr>
                    <th>APIARIO</th>
                    <th>PROVINCIA</th>
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>UNIDAD</th>
                    <th>FECHA DE COSECHA</th>
                  </tr>
                </thead>
                <tbody id="detalle_reporte_cosechas">

                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box box-success" style="display:none;" id="imprimir">
          <div class="box-body">
            <div class="chart">
              <button class="btn btn-info" onclick="imprimirReporteCosechas()" type="button" name="button">imprimir Reporte</button>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

</div>
<script src="{{ asset('js/cosechas_reporte.js') }}" defer></script>
@endsection
