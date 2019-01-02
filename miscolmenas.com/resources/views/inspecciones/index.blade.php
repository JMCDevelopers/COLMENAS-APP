@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a></li>
      <li class="active">Inspección</li>
    </ol>
  </div>

  <!-- DETALLE DE INSPECCION -->
  <div class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" id="modal_detalle_inspeccion" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="" id="titulo">DETALLE INSPECCION</h2>
        </div>
        <div class="modal-body" id="modal-body">
            <div class="table table-responsive">
              <div class="row">
                  <div class="form-group col-lg-4">
                      <label for="">Fecha de inspección:</label>
                      <span id="fecha_inspeccion_detalle"> sjjs</span>
                  </div>
                  <div class="form-group col-lg-4">

                      <label for="">Colmena:</label>
                      <span id="colmena_detalle"> sjjs</span>

                  </div>
                  <div class="form-group col-lg-4">
                      <label for="">Apiario:</label>
                      <span id="apiario_detalle"> sjjs</span>
                  </div>
              </div>

            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">INFORMACIÓN DE PRIMERA VISTA</div>
                <div class="panel-body">

                <div class="form-group col-lg-3">
                    <label for="">Reina:</label>
                    <span class="text-danger" id="reina_detalle">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Postura:</label>
                    <span class="text-danger" id="postura">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Cria sellada:</label>
                    <span class="text-danger" id="cria_sellada">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Cria nacida:</label>
                    <span class="text-danger" id="cria_nacida">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Fuerza población:</label>
                    <span class="text-danger" id="fuerza_poblacion">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Temperamento colmena:</label>
                    <span class="text-danger" id="temperamento">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Número de marcos:</label>
                    <span class="text-danger" id="marcos">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Reservas polen:</label>
                    <span class="text-danger" id="polen">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Reservas miel:</label>
                    <span class="text-danger" id="miel">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Albeolos/Celdas reales:</label>
                    <span class="text-danger" id="albeolos">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Olor:</label>
                    <span class="text-danger" id="olor">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Estado material:</label>
                    <span class="text-danger" id="material">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Clima:</label>
                    <span class="text-danger" id="clima">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Descripcion clima:</label>
                    <span class="text-danger" id="descripcion_clima">sjjs</span>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Observaciones:</label>
                    <span class="text-danger" id="observaciones">sjjs</span>
                </div>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                  <!--Condiciones colmena-->
                <div class="panel panel-primary">
                    <div class="panel-heading">Condiciones de la colmena</div>
                    <div class="panel-body">
                  <div id="contenedor_condiciones" class="table table-responsive">

                  </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-6">
                <!--Enfermedades de la colmena-->
                <div class="panel panel-primary">
                    <div class="panel-heading">Enfermedades de la colmena</div>
                    <div class="panel-body">
                  <div id="contenedor_enfermedades" class="table table-responsive">

                  </div>
                    </div>
                </div>
              </div>


            </div>

            <div class="row">
                <div class="col-lg-6">
                  <!--tratamientos de la colmena-->
                  <div class="panel panel-primary">
                      <div class="panel-heading">Tratamientos aplicados</div>
                      <div class="panel-body">
                    <div id="contenedor_tratamientos" class="table table-responsive">

                    </div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <!--tratamientos de la colmena-->
                  <div class="panel panel-primary">
                      <div class="panel-heading">Alimentos proporcionados</div>
                      <div class="panel-body">
                    <div id="contenedor_alimentos" class="table table-responsive">

                    </div>
                      </div>
                  </div>
                </div>
            </div>



          <!--imagenes de  inspeccion-->
          <div class="panel panel-primary">
              <div class="panel-heading">Imagenes Inspección</div>
              <div class="panel-body">
            <div id="" class="table table-responsive">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner" id="contenedor_imagenes_inspeccion">

                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
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
      <h3 class="box-title">Accciones</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
        </div>
      </div>

        <div class="box-body">
          <div class="row">
            <div class="form-group col-lg-3">
              <label for="apiario">Apiario:</label>
              <select class="" name="idapiario" onchange="obtenerColmenas(this.value);">
                <option value="">--Seleccione apiario--</option>
                @foreach ($apiarios as $key => $value)
                  <option value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                @endforeach
              </select>

              </div>
              <div class="form-group col-lg-3" id="contenedor_select">
              <label for="apiario">Colmena:</label>
              <select class="" name="idcolmena" id="idcolmena">
                <option value="">--Seleccione colmena--</option>
              </select>
            </div>
            <div class="form-group col-lg-3">
            <button type="button" name="button" onclick="nuevaInspeccion()" class="btn btn-warning btn-block">Nueva Inspección</button>
          </div>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Mis Inspecciones</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
            <div class="box-body">
              <div class="table-responsive" style="font-size:11px; text-align:center; cursor: pointer"  >
                <table class="table table-bordered table-hover" id="tabla_inspecciones">
                  <thead>
                    <th>#</th>
                    <th>Fecha de inspección</th>
                    <th>Observaciones</th>
                    <th>Colmena</th>
                    <th>Apiario</th>
                    <th>Acciones</th>
                  </thead>
                  <tbody>
                    @php
                      $contador=0;
                    @endphp
                    @foreach ($inspecciones as $key => $value)
                      @php
                        $contador++;
                      @endphp
                      <tr>
                        <td>{{$contador}}</td>
                        <td>{{$value->fecha_inspeccion}}</td>
                        <td>{{$value->observaciones}}</td>
                        <td>{{$value->identificador_colmena}}</td>
                        <td>{{$value->nombre_apiario}}</td>
                        <td><button type="button" class="btn btn-primary btn-xs" onclick="editarInspeccion({{$value->idinspeccion_colmena}})" ><i class="glyphicon glyphicon-pencil"></i> </button>
                          <button type="button" class="btn btn-danger btn-xs" onclick="eliminarInspeccion({{$value->idinspeccion_colmena}})" ><i class="glyphicon glyphicon-trash"></i>
                        </button> <button class="btn btn-warning btn-xs" type="button" onclick="verDeatalleInspeccion({{$value->idinspeccion_colmena}})">Ver detalle <i class="glyphicon glyphicon-eye-open"></i> </button> </td>
                      </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>
            </div>
          </div>
      <script src="{{ asset('js/inspecciones.js') }}" defer></script>
@endsection
