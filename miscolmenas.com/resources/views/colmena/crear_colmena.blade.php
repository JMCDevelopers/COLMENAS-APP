@extends('layouts/dashboard')
@section('contenido')

<link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('colmena')}}"><i class="fa fa-dashboard"></i>Colmenas</a></li>
      <li class="active">Crear Colmena</li>
    </ol>
  </div>

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
          <form class="" action="" method="post" id="frm_crear_colmena">

          <div class="panel panel-default">
            <div class="panel-heading">
              <button type="button" name="button" onclick="guardarColmena();" class="btn btn-warning">Guardar Colmena</button>
            </div>
            <div class="panel-body">

                <div class="panel-body col-lg-6">
                  <div class="form-group" id="apiario2">
                    <div class="input-group">
                      <div class="input-group-addon">
                    <label for="" class="">Apiario</label>
                  </div>

                    <select class="form-control" name="apiario_idapiario" id="apiario_idapiario">
                      <option  value="">-Seleccione-</option>
                      @foreach ($apiarios as $key => $value)
                        <option value="{{$value->idapiario}}">{{$value->nombre_apiario}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" id="apiario_alert" style="display:none;">Seleccione un apiario</span>
                  </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                    <label for="[object Object]">Nombre Colmena</label>
                  </div>

                    <input class="form-control" type="text" name="identificador_colmena" id="identificador_colmena" value="" placeholder="Identificador">
                  </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                    <label for="[object Object]">Marcos</label>
                  </div>

                    <input type="number"  class="form-control" name="num_marcos" id="num_marcos" value="" placeholder="Número de marcos">
                  </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                    <label for="" class="">Tipo Colmena</label>
                  </div>

                    <select class="form-control" name="idtipo_colmena" id="idtipo_colmena">
                      @foreach ($tipo as $key => $value1)
                        <option value="{{$value1->idtipo_colmena}}">{{$value1->nombre_tipo}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="">Descripción</label>
                    <textarea name="descripcion" cols="40"></textarea>
                  </div>
                </div>
                <div class="panel-body col-lg-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                    <label for="" class="">Procedencia</label>
                  </div>

                    <select class="form-control" name="idfuente_abeja" id="idfuente_abeja">
                      @foreach ($fuente as $key => $value2)
                        <option value="{{$value2->idfuente_abeja}}">{{$value2->nombre_fuente}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                  <!--
                  <div class="form-group">
                    <label for="" class="">Exposición al sol</label>
                    <select class="" name="idexposicion_solar" id="idexposicion_solar">
                      @foreach ($exposicion as $key => $value)
                        <option value="{{$value->idexposicion_solar}}">{{$value->nombre_exposicion}}</option>
                      @endforeach
                    </select>
                  </div>-->
                  <!--
                  <div class="form-group">
                    <label for="[object Object]">Fecha Creación</label>
                    <input type="date" name="" value="{{date('Y-m-d')}}" placeholder="">
                  </div>-->
                  <div class="form-group">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon">
                      <label for="" class="">Fuerza Población</label>
                    </div>

                    <select class="form-control" name="fuerza" id="fuerza">
                      @foreach ($porcentaje as $key => $value)
                        <option value="{{$value->porcentaje}}">{{$value->porcentaje}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                </div>

            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Incluir Reina</h4>
            </div>
            <div class="panel-body">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="[object Object]">Reinas Disponibles</label>
                  <select class="" name="idreinas" id="idreinas" onchange="verDetalleReina(this.value);">
                    <option value="">-Seleccione una reina-</option>
                    @foreach ($reinas as $key => $value)
                      <option value="{{$value->idreinas}}">{{$value->identificador_reina}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
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
                <div class=" panel panel-primary" id="cuadro1"  ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return drop(event)">

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
                <div class=" panel panel-primary" id="cuadro3"   ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return clonar(event)">
                  <span class="text-danger">Arrartre aqui! para asignar</span>
                  <h4 class="panel-title">Componentes de la colmena</h4>

                </div>
              </div>
              <div class="col-lg-6 pull-right">

                  <div id="papelera" class="panel panel-primary" ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return eliminar(event)">
                  <i class="glyphicon glyphicon-trash"></i>
                    <span class="text-danger">Papelera</span>
                    <hr>
                    <span style="font-size:10px;" class="text-success">Arrastre elemento ==></span>
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
          <button type="button" name="button" onclick="guardarColmena();" class="btn btn-warning">Guardar Colmena</button>
        </div>
      </div>
        <script src="{{ asset('js/colmenas.js') }}" defer></script>
      @endsection
