@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('reina')}}"><i class="fglyphicon glyphicon-hand-left"></i>Reinas</a></li>
      <li class="active">Editar</li>
    </ol>
  </div>
  <!--fin modal-->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Nueva Reina</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form class="" action="{{route('actualizar_reina')}}" method="post">
            {{ csrf_field() }}
            <div class="col-lg-12">
              <div class="form-group col-lg-4 {{$errors->has('identificador_reina') ? 'has-error' : ''}}">
                <label for="identificador_reina">Nombre/Código</label>
                <input type="text" class="form-control" name="identificador_reina" value="{{$reina->identificador_reina}}"  placeholder="Nombre/Codigo">
                <input type="hidden" name="idreina" value="{{$reina->idreinas}}">
                {!!$errors->first('identificador_reina','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-4 {{$errors->has('fecha_nacimiento') ? 'has-error' : ''}}">
                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="{{$reina->fecha_nacimiento}}"  placeholder="Fecha Nacimiiento">
                {!!$errors->first('fecha_nacimiento','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-4 {{$errors->has('procedencia') ? 'has-error' : ''}}">
                <label for="procedencia">Procedencia</label>
                <select class="form-control" name="procedencia">
                  <option value="">Procedencia</option>
                  <option value="Propio">Compra</option>
                  <option value="Nueva">Nueva</option>
                  <option value="Enjambre">Enjambre</option>
                </select>
                {!!$errors->first('establecimiento','<span class="help-block">:message</span>')!!}
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group col-lg-4 {{$errors->has('raza_reina_idraza_reina') ? 'has-error' : ''}}">
                <label for="raza_reina_idraza_reina">Raza</label>
                <select class="form-control" name="raza_reina_idraza_reina">
                  <option value="">Raza Reina</option>
                  @foreach ($raza as $key => $value)
                    @if ($value->idraza_reina==$reina->raza_reina_idraza_reina)
                      <option selected value="{{$value->idraza_reina}}">{{$value->nombre}}</option>
                    @else
                      <option value="{{$value->idraza_reina}}">{{$value->nombre}}</option>
                    @endif
                  @endforeach
                </select>
                {!!$errors->first('raza_reina_idraza_reina','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-4 {{$errors->has('tipo') ? 'has-error' : ''}}">
                <label for="tipo">Estado</label>
                <select class="form-control" name="tipo">
                  <option value="">Estado</option>
                    <option value="Fecundado">Fecundado</option>
                    <option value="Virgen">Virgen</option>
                </select>
                {!!$errors->first('tipo','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-4 {{$errors->has('descripcion') ? 'has-error' : ''}}">
                <label for="descripcion">Descripción</label>
                <textarea  class="form-control" name="descripcion"  placeholder="Descripción reina">{{$reina->descripcion}}</textarea>
                {!!$errors->first('descripcion','<span class="help-block">:message</span>')!!}
              </div>

              <div class="form-group col-lg-2">
                <input type="submit" class="btn btn-warning" name="guardar" value="Editar Reina">
              </div>
            </div>
          </form>


        </div>

      </div>
    <script src="{{ asset('js/reinas.js') }}" defer></script>
@endsection
