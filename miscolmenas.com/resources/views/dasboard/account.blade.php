@extends('layouts/dashboard')
@section('contenido')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard text-aqua"></i> Dasboard</a></li>
        <li class="active">Cuenta</li>
      </ol>
    </section>
    @foreach ($permisos as $key => $value)
    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Mi Cuenta:</h4>
        Información sobre tu cuenta
      </div>
    </div>
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Mis Colmenas, Inc.
          <small class="pull-right">Fecha Creación:{{$value->created_at}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">



      <div class="col-sm-4 invoice-col">
        Direccion
        <address>
          <strong>{{$value->direccion}}</strong><br>

        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Datos personales
        <address>
          <strong>{{$value->nombre}}</strong><br>

          Email: {{$value->email}}
        </address>
        <strong><a href="{{route('change_pass')}}">Cambiar Constraseña</a></strong>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">

        <br>
        <b>Cuenta:</b> {{$value->nombre_cuenta}}<br>
        <b>ID Cuenta:</b>{{$value->idcuenta_usuario}}<br>
        <b>Descripción:</b> {{$value->descripcion}}<br>
        <b>Registro de colmenas:</b> {{$value->num_colmenas}}
      </div>

      <!-- /.col -->
    </div>
    <!-- /.row -->



    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">


        <br>
        @if ($value->nombre_cuenta=="EMPRESARIAL")

        @elseif ($value->nombre_cuenta=="PREMIUM")
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Actualizar Cuenta
          </button>
        @elseif ($value->nombre_cuenta=="AVANZADO")
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Actualizar Cuenta
          </button>
        @elseif ($value->nombre_cuenta=="BASICO")
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Actualizar Cuenta
          </button>
        @endif

      </div>
    </div>
    <div class="row no-print">
      <div class="col-xs-12">


        <br>

        <div class="callout callout-warning" style="margin-bottom: 0!important;">
          <h4><i class="fa fa-info"></i> Actualizacion de cuenta:</h4>
          Si deseas actualizar a una cuenta premium comunucate a <h3>hiveapp.ec@gmail.com o al llama al 0979277861</h3>
        </div>
      </div>
    </div>
    @endforeach
  </section>
@endsection
