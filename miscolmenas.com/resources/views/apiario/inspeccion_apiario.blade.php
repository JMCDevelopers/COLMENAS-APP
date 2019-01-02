@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('apiario')}}"><i class="glyphicon glyphicon-hand-left"></i>Apiarios</a></li>
      <li class="active">inspección Apiario</li>
    </ol>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Nueva Inspección</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-body">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Datos Generales
              </div>
            </div>
            <div class="panel-body">
              <div class="form-group">
                <form class=""  id="frm_inspeccion_apiario" method="POST" action="{{route('insert_inspection')}}" enctype="multipart/form-data">
                <h2 for="apiario">APIARIO: <span class="text-danger">{{$apiario->nombre_apiario}}</span></h2>

                  {{ csrf_field() }}
                <input type="hidden" name="idapiario" value="{{$apiario->idapiario}}">
                  <input type="hidden" name="nombre_apiario" value="{{$apiario->nombre_apiario}}">
                <button type="button" class="btn btn-warning" name="button" onclick="GuardarInspeccionApiario()" >Guardar Inspección</button>
              </div>
              <div class="form-group">
                <label for="fecha">Fecha de inspección</label>
                <input type="date" name="fecha_inspeccion" value="{{date('Y-m-d')}}">
              </div>

              <div class="form-group">
                <label for="">Observaciones:</label>
                <textarea  class="form-control" name="detalle_inspeccion" rows="5" cols="80" placeholder="Ingrese detalle de la inspección"></textarea>
              </div>
              <div class="form-group">
          </div>
        </div>
        <!--imagens inspeccion-->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              Imagen de Inspección
            </div>
          </div>
          <div class="panel-body">
            <div class="panel panel-primary">
              <div class="panel-body">
                  <div class="form-group col-lg-4">
                      <label for="">Ingrese una fotografía de la inspección:</label>
                    <input type="file" name="imagen1"  >
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!--fin imagenes-->
          <!--tareas-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Establecer Tarea
              </div>
            </div>
            <div class="panel-body">
              <div class="panel panel-primary">

                <span class="text-danger">Si considera necesario defina una tarea.</span>
                <div class="panel-body">
                  <div class="col-lg-6">

                      <div class="form-group">
                      <label for="">Establesca una fecha para la tarea:</label>
                      <input type="hidden" name="estado" value="0">
                      <input type="hidden" name="tipo" value="apiario">
                      <input type="hidden" name="color" value="#F89071">
                      <input type="hidden" name="idcuenta_usuario" value="{{$cuenta_usuario}}">
                      <input type="date" name="start" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                    <label for="">Tipo de tarea a establecer?:</label>
                    <select class="" name="title">
                      <option value="">--Elija una opción</option>
                      <option value="INSPECCION">INSPECCIÓN</option>
                      <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                      <option value="SANIDAD">SANIDAD</option>
                      <option value="COSECHA">COSECHA</option>
                    </select>
                  </div>
                    <div class="form-group">
                    <label for="">Describa la tarea :</label>
                    <textarea id="tarea" rows="3" cols="80" placeholder="Describa la tarea" name="descripcion_tarea"></textarea>
                  </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="row">
                <button type="button" class="btn btn-warning" name="button" onclick="GuardarInspeccionApiario()" >Guardar Inspección</button>
              </div>
            </div>

          </div>

        </div>
      </div>
    <script src="{{ asset('js/apiarios.js') }}" defer></script>
@endsection
