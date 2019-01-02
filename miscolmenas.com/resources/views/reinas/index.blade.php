@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Reinas</li>
    </ol>
  </div>
  <!-- Modal Editar -->
  <div id="modal_eliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#dd4b39;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alerta MCL</h4>
        </div>
        <div class="modal-body">
          <p>Eliminar reina? SI, Click Eliminar | NO, Click Cancelar</p>
          <form class="" id="frm_eliminar" action="{{route('eliminar_reina')}}" method="post">
              {{ csrf_field() }}
            <input type="hidden" id="id_reina"  name="idreina" value="">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="EliminarReina();" >Eliminar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>

    </div>
  </div>
  <!--fin modal-->

  <!-- DETALLE DE PEDIDO -->
  <div class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" id="modal_detalle_reina" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="" id="titulo"></h2>
        </div>
        <div class="modal-body" id="modal-body">


          <div class="panel panel-info">
              <div class="panel-heading">Detalle de reina</div>
              <div class="panel-body">

                <div class="col-lg-12">
                  <div class="col-lg-6">
                    <label for="[object Object]">Fecha Nacimiento:</label>
                    <span class="text-danger" id="fecha_nacimiento" ></span>
                  </div>
                  <div class="col-lg-6">
                    <label for="[object Object]">Descripcion:</label>
                    <span class="text-danger" id="descripcion_reina" ></span>
                  </div>
                  <div class="col-lg-6">
                    <label for="[object Object]">Origen:</label>
                    <span class="text-danger" id="origen_reina" ></span>
                  </div>
                  <div class="col-lg-6">
                    <label for="[object Object]">Edad:</label>
                    <span class="text-danger" id="edad_reina" ></span>

                  </div>
                  <div class="col-lg-6">
                    <label for="[object Object]">Instalado:</label>
                    <span class="text-danger" id="instalado" ></span>

                  </div>
                  <div class="col-lg-6">
                    <label for="[object Object]">Estado:</label>
                    <span class="text-danger" id="estado" ></span>

                  </div>
                  <div class="col-lg-6">
                    <label for="[object Object]">Raza:</label>
                    <span class="text-danger" id="raza" ></span>

                  </div>
                </div>
              </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

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
          <form class="" action="{{route('crear_reina')}}" method="post">
            {{ csrf_field() }}
            <div class="col-lg-12">
              <div class="form-group col-lg-4 {{$errors->has('identificador_reina') ? 'has-error' : ''}}">
                <label for="identificador_reina">Nombre/Código</label>
                <input type="text" class="form-control" name="identificador_reina" value=""  placeholder="Nombre/Codigo">
                {!!$errors->first('identificador_reina','<span class="help-block">:message</span>')!!}
              </div>
              <div class="form-group col-lg-4 {{$errors->has('fecha_nacimiento') ? 'has-error' : ''}}">
                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="{{date('Y-m-d')}}"  placeholder="Fecha Nacimiiento">
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
                    <option value="{{$value->idraza_reina}}">{{$value->nombre}}</option>
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
                <textarea  class="form-control" name="descripcion"  placeholder="Descripción reina"></textarea>
                {!!$errors->first('descripcion','<span class="help-block">:message</span>')!!}
              </div>

              <div class="form-group col-lg-2">
                <input type="submit" class="btn btn-warning" name="guardar" value="Crear Reina">
              </div>
            </div>
          </form>


        </div>

      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">REINAS NUEVAS SIN INSTALAR</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                <i class="fa fa-times"></i></button>
          </div>
          </div>
            <div class="box-body" style="font-size:11px; text-align:center; cursor: pointer" id="contenedor_tabla_reinas">

          </div>
      </div>
      <!--reinas instaladas -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">REINAS INSTALADAS</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                <i class="fa fa-times"></i></button>
          </div>
          </div>
            <div class="box-body" style="font-size:11px; text-align:center; cursor: pointer" id="contenedor_tabla_inst">

          </div>
      </div>


      <script src="{{ asset('js/reinas.js') }}" defer></script>
    @endsection
