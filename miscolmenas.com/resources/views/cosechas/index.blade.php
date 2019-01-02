@extends('layouts/dashboard')
@section('contenido')

    <div class="row">
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
        <li class="active">Nueva Cosecha</li>
      </ol>
    </div>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Ingresar Cosecha</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
          <div class="box-body">
            <form class="" action="{{route('guardar_cosecha')}}" method="post" id="frm_cosecha" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group" id="apiario2">
                <label for="" class="">Fecha Cosecha:</label>
                <input type="date" name="fecha_cosecha" id="fecha_cosecha" value="{{date("Y-m-d")}}">
                <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
              </div>
              <div class="form-group" id="apiario2">
                <label for="" class="">Producto:</label>
                <select class="" name="producto" id="nombre_producto">
                  @foreach ($producto as $key => $value)
                    <option value="{{$value->nombre_producto}}">{{$value->nombre_producto}}</option>
                  @endforeach
                </select>
                <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
              </div>
              <div class="form-group" id="apiario2">
                <label for="" class="">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" value="">
                <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
                <label for="" class="">Unidad Medida:</label>
                <select class="" name="unidad_medida" id="unidad_medida">
                    @foreach ($unidad as $key => $value)
                      <option value="{{$value->nombre_unidad}}">{{$value->nombre_unidad}}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
              </div>
              <div class="form-group" id="apiario2">
                <label for="" class="">Descripción:</label>
                <textarea name="descripcion" rows="2" cols="50" id="descripcion"></textarea>
                <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
              </div>
              <div class="form-group" id="apiario2">
                <label for="" class="">Imagen:</label>
                <input type="file" name="imagen_cosecha" id="photo">
              </div>


              <div class="panel panel-default">
                <div class="panel-heading">
                  <label for="">Seleccione Apiario</label>
                  <select class="" id="apiario_id" name="idapiario">
                    @foreach ($apiarios as $key => $value)
                      <option value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                    @endforeach
                  </select>

                </div>
                </form>

              </div>

            <div class="form-group">
              <button type="button" class="btn btn-warning pull-left" name="button" onclick="GuardarCosecha()">Guardar Cosecha</button>
            </div>
          </div>

        </div>

<script src="{{ asset('js/cosechas.js') }}" defer></script>
@endsection
