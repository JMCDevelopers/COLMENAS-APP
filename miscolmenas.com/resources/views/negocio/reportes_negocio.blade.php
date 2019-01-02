@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Reportes</li>
    </ol>
  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">REPORTE NEGOCIO</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-body">
           <div class="row">
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
               <div class="col-sm-6">
                 <button onclick="generarReporte()" type="button"class="btn btn-success"  name="button">Generar Reporte</button>
               </div>
             </div>
           </div>
           <hr>
           <div class="panel" id="contendor_reporte">

           </div>
        </div>
      </div>
  <script src="{{ asset('js/negocio.js') }}" defer></script>
@endsection
