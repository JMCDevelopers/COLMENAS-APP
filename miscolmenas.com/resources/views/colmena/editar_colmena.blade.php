@extends('layouts/dashboard')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('colmena')}}"><i class="glyphicon glyphicon-hand-left"></i>Colmenas</a></li>
      <li class="active">Editar colmena</li>
    </ol>
  </div>

  <!--seccion de formulario -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Crear Colmena</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form class="" action="" method="post" id="frm_editar_colmena">
            <input type="hidden" name="idcolmenas" id="idcolmenas" value="{{$colmena->idcolmenas}}">
          <div class="panel panel-default">
            <div class="panel-heading">
              <button type="button" name="button" onclick="EditarColmena();" class="btn btn-warning">Editar Colmena</button>
            </div>
            <div class="panel-body">

                <div class="panel-body col-lg-6">
                  <div class="form-group" id="apiario2">
                    <label for="" class="">Apiario</label>
                    <select class="" name="apiario_idapiario" id="apiario_idapiario">
                      <option  value="">-Seleccione-</option>
                      @foreach ($apiarios as $key => $value)
                        @if ($colmena->apiario_idapiario==$value->idapiario)
                          <option selected value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                        @else
                          <option value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                        @endif
                      @endforeach
                    </select>
                    <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
                  </div>
                  <div class="form-group">
                    <label for="[object Object]">Nombre Colmena</label>
                    <input type="text" name="identificador_colmena" id="identificador_colmena" value="{{$colmena->identificador_colmena}}" placeholder="Identificador">
                  </div>
                  <div class="form-group">
                    <label for="[object Object]">Marcos</label>
                    <input type="number"  name="num_marcos" id="num_marcos" value="{{$colmena->num_marcos}}" placeholder="Número de marcos">
                  </div>
                  <div class="form-group">
                    <label for="" class="">Tipo Colmena</label>
                    <select class="" name="idtipo_colmena" id="idtipo_colmena">
                      @foreach ($tipo as $key => $value1)
                        @if ($value->idtipo_colmena=$colmena->idtipo_colmena)
                            <option selected value="{{$value1->idtipo_colmena}}">{{$value1->nombre_tipo}}</option>
                        @else
                            <option value="{{$value1->idtipo_colmena}}">{{$value1->nombre_tipo}}</option>
                        @endif

                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="" class="">Descripción</label>
                    <textarea name="descripcion" cols="40">{{$colmena->descripcion}}</textarea>
                  </div>
                </div>
                <div class="panel-body col-lg-6">
                  <div class="form-group">
                    <label for="" class="">Procedencia</label>
                    <select class="" name="idfuente_abeja" id="idfuente_abeja">
                      @foreach ($fuente as $key => $value2)
                        @if ($value2->idfuente_abeja==$colmena->idfuente_abeja)
                          <option selected value="{{$value2->idfuente_abeja}}">{{$value2->nombre_fuente}}</option>
                        @else
                          <option value="{{$value2->idfuente_abeja}}">{{$value2->nombre_fuente}}</option>
                        @endif

                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="" class="">Exposición al sol</label>
                    <select class="" name="idexposicion_solar" id="idexposicion_solar">
                      @foreach ($exposicion as $key => $value)
                        @if ($value->idexposicion_solar==$colmena->idexposicion_solar)
                          <option selected value="{{$value->idexposicion_solar}}">{{$value->nombre_exposicion}}</option>
                        @else
                          <option value="{{$value->idexposicion_solar}}">{{$value->nombre_exposicion}}</option>
                        @endif

                      @endforeach
                    </select>
                  </div>
                  <!--
                  <div class="form-group">
                    <label for="[object Object]">Fecha Creación</label>
                    <input type="date" name="" value="{{date('Y-m-d')}}" placeholder="">
                  </div>-->
                  <div class="form-group">
                    <label for="" class="">Fuerza Población</label>
                    <select class="" name="fuerza" id="fuerza">
                      @foreach ($porcentaje as $key => $value)
                        @if ($value->porcentaje==$colmena->fuerza)
                          <option selected value="{{$value->porcentaje}}">{{$value->porcentaje}}</option>
                        @else
                          <option value="{{$value->porcentaje}}">{{$value->porcentaje}}</option>
                        @endif

                      @endforeach
                    </select>
                  </div>
                </div>

            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Incluir Reina</h4>
            </div>
            <div class="panel-body">
              <div class="col-lg-3" id="contenedor_select">



              </div>
              <input type="hidden" id="id_reina" value="{{$colmena->idreinas}}">
              <div class="col-lg-9" id="contenedor_detalle_reina">

              </div>
            </div>
          </div>
            </form>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">COMPONENTES DE LA COLMENA</h4>
            </div>
            <div class="panel-body" onload="comprobarnavegador();">

              <div class="col-lg-6">
                <div class="panel panel-primary" id="cuadro1"  ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return drop(event)">
                  <h4 class="panel-title">Componentes Disponibles</h4>

                    @foreach ($materiales as $key => $value)
                      <div class="row col-lg-4" id="{{$value->idmaterial}}" draggable="true" ondragstart="start(event)" ondragend="end(event)">
                        <input type="image" src="{{asset(''.$value->url_imagen.'')}}" alt="{{$value->nombre_componente}}" disabled>
                          <span  class="text-danger">{{$value->nombre_componente}}</span>
                      </div>
                    @endforeach

                </div>
              </div>


              <div class="col-lg-6" >
                <div class="panel panel-primary" id="cuadro3"  ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return clonar(event)">
                  <h4 class="panel-title">Componentes de la colmena</h4>
                  @foreach ($material_colmena as $key => $val3)
                    <div class="row col-lg-4 clon" id="{{$val3->idmaterial.'c'}}" draggable="true" ondragstart="start(event)" ondragend="end(event)" style="position: static;">
                        <input src="{{asset(''.$val3->url_imagen.'')}}" alt="{{$val3->nombre_componente}}" disabled type="image">
                          <span class="text-danger">{{$val3->nombre_componente}}</span>
                    </div>
                  @endforeach

                </div>
              </div>
              <div class="col-lg-6 pull-right">

                  <div id="papelera" class="panel panel-primary" ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return eliminar(event)">
                  <i class="glyphicon glyphicon-trash"></i>
                    <span class="text-danger">Papelera</span>
                    <hr>
                    <span class="text-success">Arrastre aqui el elemento a borrar ==></span>
                    </div>
              </div>
              <!--
              <div class=" col-lg-6">
                <div class="form-group">
                  <label for="[object Object]">Otros:</label>
                  <textarea class="form-control" name="otros_componentes" placeholder="Otros componentes de la colmena"></textarea>
                </div>
              </div>-->
            </div>


          </div>

        </div>
        <div class="box-footer">
          <button type="button" name="button" onclick="EditarColmena();" class="btn btn-warning">Editar Colmena</button>
        </div>
      </div>
  <!--fin seccion -->

<script src="{{ asset('js/edicion_colmena.js') }}" defer></script>
@endsection
