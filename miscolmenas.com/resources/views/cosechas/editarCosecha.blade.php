@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('lista_cosechas')}}"><i class="glyphicon glyphicon-hand-left"></i>Cosechas</a></li>
      <li class="active">Editar Cosecha</li>
    </ol>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Editar Cosecha</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-body">
          <form class="" action="{{route('actualizar_cosecha')}}" method="post" id="frm_cosecha_editar" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group" id="apiario2">
              <input type="hidden" name="idcosechas" id="idcos" value="{{$cosecha_editar->idcosechas}}">
              <label for="" class="">Fecha Cosecha:</label>
              <input type="date" name="fecha_cosecha" id="fecha_cosecha" value="{{$cosecha_editar->fecha_cosecha}}">
              <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
            </div>
            <div class="form-group" id="apiario2">
              <label for="" class="">Producto:</label>
              <select class="" name="producto" id="nombre_producto">
                @foreach ($producto as $key => $value)
                @if($cosecha_editar->producto==$value->nombre_producto){
                    <option selected value="{{$value->nombre_producto}}">{{$value->nombre_producto}}</option>
                  }
                  @else{
                  <option value="{{$value->nombre_producto}}">{{$value->nombre_producto}}</option>
                }
                @endif
                @endforeach
              </select>
              <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
            </div>
            <div class="form-group" id="apiario2">
              <label for="" class="">Cantidad:</label>
              <input type="number" name="cantidad" id="cantidad" value="{{$cosecha_editar->cantidad}}">
              <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
              <label for="" class="">Unidad Medida:</label>
              <select class="" name="unidad_medida" id="unidad_medida">
                  @foreach ($unidad as $key => $value)
                    @if($cosecha_editar->unidad_medida==$value->nombre_unidad){
                      <option selected value="{{$value->nombre_unidad}}">{{$value->nombre_unidad}}</option>
                    }@else{
                      <option value="{{$value->nombre_unidad}}">{{$value->nombre_unidad}}</option>
                    }
                  @endif
                  @endforeach
              </select>
              <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
            </div>
            <div class="form-group" id="apiario2">
              <label for="" class="">Descripción:</label>
              <textarea name="descripcion" rows="2" cols="50" id="descripcion">{{$cosecha_editar->descripcion}}</textarea>
              <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
            </div>
            <div class="form-group" id="apiario2">
              <label for="" class="">Imagen:</label>
              <input type="file" name="imagen_cosecha" id="photo">
            </div>

            <input type="hidden" name="colmenas_cosechadas" value="" id="colmenas_cos">
            <div class="form-group">
              <label for="">Imagen de cosecha</label>
              <img width="300px" height="300px"  src="/storage/{{$cosecha_editar->url_imagenl}}" alt="">
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <label for="">Seleccione Apiario</label>
                <select class="" id="apiario_id" name="idapiario">
                  @foreach ($apiarios as $key => $value)
                    @if ($cosecha_editar->idapiario==$value->idapiario)
                      <option selected value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                    @else
                      <option value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                    @endif

                  @endforeach
                </select>

              </div>
              </form>
              
            </div>
            @php
              //print_r($colmenas);
            @endphp

          <div class="form-group">
            <button type="button" class="btn btn-warning pull-left" name="button" onclick="ActualizarCosecha()">Guardar Cosecha</button>
          </div>
        </div>

      </div>

<script src="{{ asset('js/cosechas.js') }}" defer></script>
@endsection
