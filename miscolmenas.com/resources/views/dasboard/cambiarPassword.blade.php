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
<div class="panel panel-info">
  <div class="panel-heading">
    <div class="panel-title">
      Cambiar Constraseña
    </div>
  </div>
  <div class="panel-body">
    <div class="col-lg-6">
      <form class="form-vertical" action="{{route('actualizar_pass')}}" method="post">
          {{ csrf_field() }}
          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

              <div class="col-md-6">
                  <input id="password" placeholder="Nueva Constrasña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

              <div class="col-md-6">
                  <input id="password-confirm" placeholder="Confirmar Nueva Constraseña" type="password" class="form-control" name="password_confirmation" required>
              </div>
          </div>
      <div class="form-group">
        <input type="submit"class="btn btn-success" value="Cambiar">
      </div>
      </form>
    </div>
  </div>
</div>
  @endsection
