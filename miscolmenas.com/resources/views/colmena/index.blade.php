@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Colmenas</li>
    </ol>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Seleccion colmenas por apiario</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="panel panel-default">
            <div class="panel-body">

              <div class="form-group col-lg-1">
                <label class="" for="apiario">FILTRAR APIARIO</label>
              </div>
              <div class="form-group col-lg-4">
                <select class="form-control" name="idapiario" id="idapiario" onchange="ConsultarPorApiario(this.value)">
                  <option value="">
                    - Selecciona un apiario-
                  </option>
                  @foreach ($apiarios as $key => $value)
                    <option value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                  @endforeach
                  <option value="">
                    TODO
                  </option>
                </select>
              </div>
              <div class="form-group col-lg-2">

              </div>
            </div>

          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <div class="form-group col-lg-3">
              </div>
              <div class="form-group col-lg-3">
                <button type="button" name="button" class="btn btn-warning btn-block" onclick="generarCodigosQr()">Generar Codigo QR</button>
              </div>
              <div class="form-group col-lg-3">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="modal-default-colmena">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Nueva Colmena</h4>
            </div>
            <div class="modal-body">
              <form class="" action="" method="post" id="frm_crear_colmena">
                <div class="panel-body">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon">
                        <label for="[object Object]">Identificador</label>
                      </div>
                      <input type="hidden" name="" id="id_apiario" value="">
                        <input class="form-control" type="text" name="identificador_colmena" id="identificador_colmena" value="" placeholder="Identificador">
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon">
                        <label for="" class="">Tipo</label>
                      </div>
                        <select class="form-control" name="tipo_colmena" id="tipo_colmena">
                          <option value="">Seleccione</option>
                          <option value="Núcleo">Núcleo</option>
                          <option value="Camara de Cría">Camara de Cría</option>
                          <option value="Colmena Completa">Colmena Completa</option>
                          <option value="Otro">Otro</option>
                        </select>
                      </div>
                      </div>
                      <div class="form-group">
                        <label for="" class="">Descripción</label>
                        <textarea class="form-control" id="descripcion_colmena" cols="40"></textarea>
                      </div>


                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon">
                        <label for="" class="">Orígen</label>
                      </div>

                        <select class="form-control" name="idfuente_abeja" id="origen_colmena">
                          <option value="">Seleccione</option>
                          <option value="División">División</option>
                          <option value="Compra">Compra</option>
                          <option value="Enjambre">Enjambre</option>
                          <option value="Otro">Otro</option>
                        </select>
                      </div>
                      </div>
                      <!-- radio -->
              </div>
              <div class="box collapsed-box">
                <div class="box-header with-border">


                  <div class="box-tools pull-right">
                    <button type="button" onclick="incluyeReina();" class="btn btn-box-tool btn-link" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
                      <a>Incluir Reina ahora ?</a></button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                        <i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body" style="font-size:11px; cursor: pointer" id="">
                      <div class="row">
                        <span class="text-danger">Si dispones un código  de seguimiento de reina ingresalo aqui!!</span>
                        <div class="form-group">
                          <input type="text" id="codigo_seguimiento" value="" class="form-control" placeholder="CODIGO DE SEGUIMIENTO">
                        </div>
                      </div>
                      <div class="row" id="form-reinas" style="display:block">
                        <div class="form-group">
                          <label for="[object Object]">Identificador</label>
                          <input type="text" class="form-control" id="identificador_reina" value="" placeholder="IDENTIFICADOR REINA">
                        </div>
                        <div class="form-group">
                          <label for="[object Object]">Raza</label>
                          <select class="form-control" id="raza">
                            <option value="">---Seleccione--</option>
                            <option value="Carnica">Carnica</option>
                            <option value="Italiana">Italiana</option>
                            <option value="Híbrida">Híbrida</option>
                            <option value="Nacional">Nacional</option>
                            <option value="OTRO">OTRO</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="[object Object]">Orígen</label>
                          <select class="form-control" id="origen">
                            <option value="">---Seleccione--</option>
                            <option value="Compra">Compra</option>
                            <option value="Enjambre">Enjambre</option>
                            <option value="Propio">Propio</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="[object Object]">Fecha de nacimiento</label>
                          <input type="date" id="fecha_nacimiento"  value="{{date('Y-m-d')}}" size="5px" class="form-control" value="" >
                        </div>
                      </div>

                      <div   class="col-lg-9" id="contenedor_detalle_reina">

                      </div>
                    </div>
                  </div>

                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <button type="button" onclick="insertarColmena();" class="btn btn-primary">Guardar Colmena</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <!--reinas instaladas -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">COLMENAS POR APIARIO</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="font-size:11px; text-align:center; cursor: pointer" id="contenedor_tabla_inst">

              @foreach ($apiario as $key => $row)
                <div class="panel panel-info">
                  <div class="panel-heading">
                        <h4 class="panel-tittle">APIARIO: <span class="text-danger"> {{$row->nombre_apiario}}</span></h4>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-6">
                        <!--
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" placeholder="Identificador Colmena">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat">Buscar</button>
                              </span>
                        </div>-->
                      </div>
                      <div class="col-lg-6">
                        <button type="button" class="btn btn-success btn-xs" name="button" data-toggle="modal" data-target="#modal-default-colmena" onclick="agregarColmena({{$row->idapiario}});">Agregar Colmena</button>
                      </div>
                    </div>
                    <hr>
                        @php
                        $contador=0;
                        @endphp
                        @foreach ($colmenas as $key => $row1)
                          @if ($row->idapiario==$row1->idapiario)
                            @php
                            $contador++;
                            @endphp
                            <div class="panel panel-primary col-lg-2 col-md-2">
                            <button type="button" class="btn btn-link" name="button" onclick="EliminarColmena({{$row1->idcolmenas}})"><i class="glyphicon glyphicon-remove"></i></button>
                              <div class="panel" onclick="gestionColmena({{$row1->idcolmenas}})">
                                <h5  class="text-danger">{{$contador}}:  {{$row1->identificador_colmena}}</h5>
                                <img  src="{{asset('img/logo_colmena.jpg')}}" alt="oll">
                              </div>
                            </div>
                          @endif
                        @endforeach
                  </div>
                </div>
              @endforeach

            </div>
          </div>
          <script src="{{ asset('js/colmenas.js') }}" defer></script>
        @endsection
