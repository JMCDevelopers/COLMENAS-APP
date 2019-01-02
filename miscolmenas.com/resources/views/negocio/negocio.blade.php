@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Inspección</li>
    </ol>
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
          AQUI VAN LOS PAGOS
        </div>
      </div>
  <script src="{{ asset('js/negocio.js') }}" defer></script>
@endsection
