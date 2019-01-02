@extends('layouts/dashboard')
@section('contenido')

  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('apiario')}}"><i class="glyphicon glyphicon-hand-left"></i>Apiarios</a></li>
      <li class="active">Editar</li>
    </ol>
  </div>

<!--formulario de edicion apiario-->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Editar Apiario</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          @foreach ($dato as $key => $value)
          <form class="" action="{{route('actualizar_apiario')}}" method="post">
            {{ csrf_field() }}
            <div class="col-lg-12">
              <div class="form-group col-lg-4 {{$errors->has('nombre_apiario') ? 'has-error' : ''}}">
                <label for="nombre_apiario">Nombre Apiario</label>
                <input type="text" class="form-control" name="nombre_apiario" value="{{$value->nombre_apiario}}"  placeholder="Nombre apiario">
                <input type="hidden" name="idapiario" value="{{$value->idapiario}}">
                {!!$errors->first('nombre_apiario','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-4 {{$errors->has('direccion') ? 'has-error' : ''}}">
                <label for="direccion">Direccion</label>
                <input type="text" class="form-control" name="direccion" value="{{$value->direccion}}"  placeholder="Direccion apiario">
                {!!$errors->first('direccion','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-4 {{$errors->has('provincia') ? 'has-error' : ''}}">
                <label for="provincia">Provincia</label>
                <select class="form-control" name="provincia">
                  <option value="[object Object]">Provincias</option>
                  @foreach ($provincias as $key => $row)
                    @if($row->idprovincia==$value->provincia_idprovincia)
                      <option  selected value="{{$row->idprovincia}}">{{$row->nombre_provincia}}</option>
                    @else
                      <option value="{{$row->idprovincia}}">{{$row->nombre_provincia}}</option>
                    @endif
                  @endforeach
                </select>
                {!!$errors->first('provincia','<span class="help-block">:message</span>')!!}
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group col-lg-4 {{$errors->has('descripcion') ? 'has-error' : ''}}">
                <label for="descripcion">Descripción</label>
                <textarea  class="form-control" name="descripcion"   placeholder="Descripción apiario">{{$value->descripcion}}</textarea>
                {!!$errors->first('descripcion','<span class="help-block">:message</span>')!!}
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group col-lg-4 {{$errors->has('establecimiento') ? 'has-error' : ''}}">
                <label for="establecimiento">Establecimiento</label>
                <select class="form-control" name="establecimiento">
                  <option value="Propio">Propio</option>
                  <option value="Arrendado">Arrendado</option>
                </select>
                {!!$errors->first('establecimiento','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-2">
                <br>
                <input type="submit" class="btn btn-warning" name="guardar" value="Actualizar Apiario">
              </div>
            </div>
          </form>
            @endforeach
        </div>

      </div>










          <script src="{{ asset('js/apiarios.js') }}" defer></script>
        @endsection
