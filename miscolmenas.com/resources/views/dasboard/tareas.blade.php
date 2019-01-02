@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard text-aqua"></i>Dashboard</a></li>
      <li class="active">Tareas</li>
    </ol>
  </div>
  <link href='{{asset('css/calendario.css')}}' rel='stylesheet' />
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Nueva Tarea</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

              <div class="panel-body" style="font-size:11px; cursor: pointer" >
                <form class="" action="index.html" method="post" id="frm_crear_tarea">
                  <div class="form-group">
                    <label for="">Fecha de tara:</label>
                    <input type="hidden" name="estado" value="0">
                    <input type="hidden" name="tipo" value="cualquiera">
                    <input type="hidden" name="color" value="#F89071">
                    <input type="hidden" name="idcuenta_usuario" value="{{$cuenta_usuario}}">
                    <input type="date" name="start" id="start" value="{{date('Y-m-d')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Titulo de tara:</label>
                    <input type="text" name="title" value="" >
                  </div>
                  <div class="form-group">
                    <label for="">Descripción:</label>
                    <textarea name="descripcion_tarea" rows="5" cols="80" > </textarea>
                  </div>

                </form>
                <div class="row">
                  <div class="col-lg-3">
                    <button class="btn btn-primary btn-block" type="button" name="button" onclick="CrearTarea()">Crear tarea</button>
                  </div>

                </div>
              </div>

        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">


          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

                <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3>Tareas Pendientes</h3>
                     </div>
                    <div class="panel-body" style="font-size:11px; cursor: pointer" >
                    <table class="table table-bordered table-hover" id="tabla_treas">
                      <thead>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Fecha Tarea</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </thead>
                      <tbody>
                        @php
                          $contador=0;
                        @endphp
                        @foreach ($tareas_pendientes as $key => $value)
                          @php
                          $est="";
                            $contador++;
                            if($value->estado=="1"){
                              $est="Realizado";
                            }else{
                              $est="Pendiente";
                            }
                          @endphp
                          <tr>
                            <td onclick="editarTarea({{$value->idtareas}})" style="background:{{$value->color}}">{{$contador}}</td>
                            <td onclick="editarTarea({{$value->idtareas}})" style="background:{{$value->color}}">{{$value->title}}</td>
                            <td onclick="editarTarea({{$value->idtareas}})" style="background:{{$value->color}}">{{$value->descripcion_tarea}}</td>
                            <td onclick="editarTarea({{$value->idtareas}})" style="background:{{$value->color}}">{{$value->start}}</td>
                            <td onclick="editarTarea({{$value->idtareas}})" style="background:{{$value->color}}">{{$est}}</td>
                            <td>
                              @if ($value->estado=="0")
                                  <button class="btn btn-info btn-xs" type="button" onclick="editarTarea({{$value->idtareas}})"><i class="glyphicon glyphicon-tasks"></i> </button>
                              @endif
                              <button class="btn btn-danger btn-xs" type="button" name="button" onclick="eliminarTarea({{$value->idtareas}})"><i class="glyphicon glyphicon-trash"></i> </button>
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3>Tareas Finalizadas</h3>
                     </div>
                    <div class="panel-body" style="font-size:11px; cursor: pointer" >
                    <table class="table table-bordered table-hover" id="tabla_treas_finalizadas">
                      <thead>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Fecha Tarea</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </thead>
                      <tbody>
                        @php
                          $contador=0;
                        @endphp
                        @foreach ($tareas_realizadas as $key => $value)
                          @php
                          $est="";
                            $contador++;
                            if($value->estado=="1"){
                              $est="Realizado";
                            }else{
                              $est="Pendiente";
                            }
                          @endphp
                          <tr>
                            <td  style="background:{{$value->color}}">{{$contador}}</td>
                            <td  style="background:{{$value->color}}">{{$value->title}}</td>
                            <td  style="background:{{$value->color}}">{{$value->descripcion_tarea}}</td>
                            <td  style="background:{{$value->color}}">{{$value->start}}</td>
                            <td  style="background:{{$value->color}}">{{$est}}</td>
                            <td>
                              <button class="btn btn-danger btn-xs" type="button" name="button" onclick="eliminarTarea({{$value->idtareas}})"><i class="glyphicon glyphicon-trash"></i> </button>
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
                </div>

            </div>
          </div>


<script src="{{ asset('js/dashboard.js') }}" defer></script>
<script src="{{ asset('js/tareas.js') }}" defer></script>
@endsection
