@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('gestion_tareas')}}"><i class="glyphicon glyphicon-hand-left text-aqua"></i>Treas</a></li>
      <li class="active">Tareas</li>
    </ol>
  </div>

  <div class="panel-body">
    <div class="panel panel-info">
        <div class="panel-heading">Puede recordinar fecha de tarea o finalizarla </div>
        <div class="panel-body" style="font-size:11px; cursor: pointer" >
          <form class="" action="index.html" method="post">
            <div class="form-group">
              <label for="">Fecha de tara:</label>
              <input type="date" id="start" value="{{$tarea->start}}">
            </div>
            <div class="form-group">
              <label for="">Titulo de tara:</label>
              <input type="text" name="title" value="{{$tarea->title}}" readonly>
            </div>
            <div class="form-group">
              <label for="">Descripción:</label>
              <textarea name="descripcion_tarea" rows="5" cols="80" readonly> {{$tarea->descripcion_tarea}}</textarea>
            </div>
            <div class="form-group">
              <label for="">Estado:</label>
              @php
              $estado="";
                if($tarea->estado=="0"){
                  $estado="Pendiente";
                }else if($tarea->estado=="1"){
                  $estado="Finalizada";
                }
              @endphp
              <input type="text" name="estado" value="{{$estado}}" readonly>
            </div>
          </form>
          <div class="row">
            <div class="col-lg-3">
              <button class="btn btn-primary btn-block" type="button" name="button" onclick="recordinarTarea({{$tarea->idtareas}})">Recordinar</button>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-success btn-block" type="button" name="button" onclick="finalizarTarea({{$tarea->idtareas}})">Finalizar Tarea</button>
            </div>
          </div>
        </div>
    </div>
  </div>

<script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection
