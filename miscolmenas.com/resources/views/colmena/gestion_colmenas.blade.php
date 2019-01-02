@extends('layouts/dashboard')
@section('contenido')

  <!--modal detalle inspeccion-->
    <div class="modal fade" id="md_detalle_inspecion">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Detalle de Inspección</h4>
          </div>
          <div class="modal-body" style="font-size:11px; cursor: pointer" id="">
            <table>
              <tbody>
                <tr>
                  <th>Fecha Inspección:</th>
                  <td id="fecha_detalle_inspeccion">

                  </td>
                </tr>
                <tr>
                  <th>Reina en colmena:</th>
                  <td id="reina_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Postura de le reina:</th>
                  <td id="postura_detalle" >

                  </td>
                </tr>
                <tr>
                  <th>Celdas reales:</th>
                  <td id="albeolos_detalle" >

                  </td>
                </tr>
                <tr>
                  <th>Cría recien nacida:</th>
                  <td id="cria_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Población de la colmena:</th>
                  <td id="poblacion_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Temperamento de la colmena:</th>
                  <td id="temperamento_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Reservas de polen:</th>
                  <td id="polen_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Reservas de miel:</th>
                  <td id="miel_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Observaciones Generales:</th>
                  <td id="observaciones_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Enfermedades presentes en la colmena:</th>
                  <td id="enfermedad_detalle">

                  </td>
                </tr>
                <tr>
                  <th>Observaciones y tratamioentos :</th>
                  <td id="tratamientos_detalle">

                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row" id="contenedor_imagen_detalle">
              imagen

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-info">CERRAR</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

  <!--modal ingresar inspeccion-->
    <div class="modal fade" id="md_nueva_inspeccion">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ingresar Inspección</h4>
          </div>
          <div class="modal-body" style="font-size:11px; cursor: pointer" id="">
            <div class="panel panel-body">
              <form class="form" id="form_inspeccion" action="{{route('inspeccionar_colmena')}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" id="id_inspeccion" name="id_inspeccion" value="">
                  <input type="hidden" id="tipo_transaccion" name="tipo_transaccion" value="">
                <input type="hidden" name="id_colmena" value="{{$colmena->idcolmenas}}">
              <div class="row" >
                <div class="form-group">
                  <label for="[object Object]">Fecha Inspección</label>
                  <input type="date" class="form-control" name="fecha_inspeccion" id="fecha_inspeccion" value="" >
                </div>
                <div class="form-group">
                  <label for="[object Object]">Reina</label>
                  <select class="form-control"  name="reina" id="reina_vista">
                    <option value="">---Seleccione--</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Postura Reina</label>
                  <select class="form-control" name="postura_reina" id="postura_reina">
                    <option value="">---Seleccione--</option>
                    <option value="BUENA">BUENA</option>
                    <option value="MALA">MALA</option>
                    <option value="SIN POSTURA">SIN POSTURA</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Celdas Reales</label>
                  <select class="form-control" id="celdas_reales" name="celdas_reales">
                    <option value="">---Seleccione--</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Cría Recien Nacida</label>
                  <select class="form-control" id="cria" name="cria">
                    <option value="">---Seleccione--</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Población de la colmena</label>
                  <select class="form-control" id="poblacion" name="poblacion">
                    <option value="">---Seleccione--</option>
                    <option value="CRITICO">CRITICO</option>
                    <option value="DEBIL">DEBIL</option>
                    <option value="MODERADO">MODERADO</option>
                    <option value="FUERTE">FUERTE</option>
                    <option value="OBRE POBLADO">SOBRE POBLADO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Temperamento Colmena</label>
                  <select class="form-control" id="temperamento" name="temperamento">
                    <option value="">---Seleccione--</option>
                    <option value="TRANQUILA">TRANQUILA</option>
                    <option value="AGRESIVA">AGRESIVA</option>
                    <option value="NERVIOSA">NERVIOSA</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Reservas de polen</label>
                  <select class="form-control" id="polen" name="polen">
                    <option value="">---Seleccione--</option>
                    <option value="ALTO">ALTO</option>
                    <option value="MEDIO">MEDIO</option>
                    <option value="BAJO">BAJO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Reservas de miel</label>
                  <select class="form-control" id="miel" name="miel">
                    <option value="">---Seleccione--</option>
                    <option value="ALTO">ALTO</option>
                    <option value="MEDIO">MEDIO</option>
                    <option value="BAJO">BAJO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Observaciones generales</label>
                  <textarea  rows="8" class="form-control" cols="80" name="obervaciones_inspeccion" id="obervaciones_inspeccion"></textarea>
                  </select>
                </div>
                <div class="form-group">
                  <label for="[object Object]">Enfermedades</label>
                  <select class="form-control" id="enfermedades" name="enfermedades">
                    <option value="">---Seleccione--</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Enfermedades y tratamientos aplicadas a la colmena</label>
                  <textarea rows="8" class="form-control" cols="80" name="tratamientos_colmena" id="tratamientos_colmena"></textarea>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Imagen Inspección</label>
                  <input type="file" name="imagen_inspeccion"class="form-control"  value="">
                  </select>
                </div>
              </div>

            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit"  id="boton_inspeccion" class="btn btn-primary">Guardar Inspeccion</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

  <!--modal ingresar reina-->
    <div class="modal fade" id="md_nueva_reina">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ingresar Reina</h4>
          </div>
          <div class="modal-body" style="font-size:11px; cursor: pointer" id="">
            <div class="panel panel-body">
              <div class="row" >
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

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" onclick="insertarReina({{$colmena->idcolmenas}});" class="btn btn-primary">Guardar Colmena</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@if(!empty($reina) and !is_null($edad_reina))
  <!--modal editar identificador-->
    <div class="modal fade" id="md_detalle_reina">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Deatalle de reina</h4>
          </div>

          <div class="modal-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>IDENTIFICADOR REINA: </th>
                  <td>{{$reina->identificador_reina}}</td>
                </tr>
                <tr>
                  <th>EDAD REINA: </th>
                  <td><span class="text-danger">{{$edad_reina}}</span>  meses</td>
                </tr>
                <tr>
                  <th>RAZA REINA: </th>
                  <td>{{$reina->raza}}</td>
                </tr>
                <tr>
                  <th>ORIGEN REINA: </th>
                  <td>{{$reina->origen_reina}}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  @endif

  @if(!empty($reina_venta) and !is_null($edad_reina))
    <!--modal editar identificador-->
      <div class="modal fade" id="md_detalle_reina">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Deatalle de reina</h4>
            </div>

            <div class="modal-body">
              <table class="table">
                <tbody>
                  <tr>
                    <th>IDENTIFICADOR REINA: </th>
                    <td>{{$reina_venta->identificador_reina}}</td>
                  </tr>
                  <tr>
                    <th>EDAD REINA: </th>
                    <td><span class="text-danger">{{$edad_reina}}</span>  meses</td>
                  </tr>
                  <tr>
                    <th>RAZA REINA: </th>
                    <td>{{$reina_venta->raza}}</td>
                  </tr>
                  <tr>
                    <th>ORIGEN REINA: </th>
                    <td>{{$reina_venta->criadero}}</td>
                  </tr>
                  <tr>
                    <th>HISTORIAL: </th>
                    <td>{{$reina_venta->historial}}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <button type="button" data-dismiss="modal" class="btn btn-info">Aceptar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    @endif

<!--modal editar identificador-->
  <div class="modal fade" id="md_editar_idenficador">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Editar Identificador</h4>
        </div>

        <div class="modal-body">
          <div class="panel-body">
              <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                    <label for="[object Object]">Identificador: </label>
                </div>
                <input class="form-control" type="text" name="identificador_colmena" id="identificador_colmena" value="" placeholder="Identificador">
                  </div>
              </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="button" onclick="editarIdentificador();" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!--modal editar descripción-->
    <div class="modal fade" id="md_editar_descripcion">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Descripción</h4>
          </div>

          <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                      <label for="[object Object]">Descripción: </label>
                  </div>
                  <input class="form-control" type="text" name="identificador_colmena" id="descripcion_colmena" value="" placeholder="descrición de la colmena">
                    </div>
                </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" onclick="editarDescripcion();" class="btn btn-primary">Guardar Cambios</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!--modal editar  tipo colmena -->
      <div class="modal fade" id="md_editar_tipo_colmena">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Editar Tipo Colmena</h4>
            </div>

            <div class="modal-body">
              <div class="panel-body">
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
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <button type="button" onclick="editarTipoColmena();" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <!--modal editar  origen colmena -->
        <div class="modal fade" id="md_editar_origen_colmena">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Orígen</h4>
              </div>

              <div class="modal-body">
                <div class="panel-body">
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
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="editarOrigenColmena();" class="btn btn-primary">Guardar Cambios</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('colmena')}}"><i class="glyphicon glyphicon-dashboard"></i>Colmenas</a></li>
      <li class="active">Gestion Colmena</li>
    </ol>
  </div>
  <div class="row" >
    <button type="button" name="button" class="btn btn-link" onclick="EliminarColmena({{$colmena->idcolmenas}})">Eliminar Colmena</button>
  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">INFORMACION GENERAL DE LA COLMENA</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <input type="hidden" name="" id="id_colmena" value="{{$colmena->idcolmenas}}">
          <table class="table">
            <tbody>
              <tr>
                <th>IDENTIFICADOR: </th>
                <td> <p>{{$colmena->identificador_colmena}}</p> </td>
                <td>

                    <button type="button" class="btn btn-link" name="button" data-toggle="modal" data-target="#md_editar_idenficador" onclick="obtenerIdentificador('{{$colmena->identificador_colmena}}');" >Editar</button>
                </td>
              </tr>
              <tr>
                <th>FECHA DE CREACIÓN: </th>
                <td>{{$colmena->created_at}}</td>
                <td>
                  ------
                </td>
              </tr>
              <tr>
                <th>DESCRIPCIÓN: </th>
                <td>{{$colmena->descripcion}}</td>
                <td>
                  <button type="button" class="btn btn-link" name="button" data-toggle="modal" data-target="#md_editar_descripcion" onclick="obtenerDescripcion('{{$colmena->descripcion}}');" >Editar</button>
                </td>
              </tr>
              <tr>
                <th>TIPO DE COLMENA: </th>
                <td>{{$colmena->tipo_colmena}}</td>
                <td>
                  <button type="button" class="btn btn-link" name="button" data-toggle="modal" data-target="#md_editar_tipo_colmena" onclick="obtenerTipoColmena('{{$colmena->tipo_colmena}}');" >Editar</button>
                </td>
              </tr>
              <tr>
                <th>ORÍGEN COLMENA: </th>
                <td>{{$colmena->procedencia_colmena}}</td>
                <td>
                  <button type="button" class="btn btn-link" name="button" data-toggle="modal" data-target="#md_editar_origen_colmena" onclick="obtenerOrigenColmena('{{$colmena->procedencia_colmena}}');" >Editar</button>
                </td>

              </tr>
              <tr>
                <th>REINA: </th>
                @php
                  $identificador="";
                  if(!empty($reina)){
                    $identificador=$reina->identificador_reina;
                  }
                  if(!empty($reina_venta)){
                    $identificador=$reina_venta->identificador_reina;
                  }
                @endphp
                  @if(empty($reina) and empty($reina_venta))
                    <td>
                    <span class="text-danger">Sin asignar</span>
                    <button type="button" class="btn btn-link" name="button" onclick="ingresar();" data-toggle="modal" data-target="#md_nueva_reina"  >Ingresar Reina!</button>
                  @else
                    <td>
                    <button type="button" class="btn btn-success btn-xs" name="button" data-toggle="modal" data-target="#md_detalle_reina" onclick="" >{{$identificador}} - ver detalle</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-xs" onclick="eliminarReina({{$colmena->idcolmenas}});" name="button">Eliminar Reina</button>
                  </td>
                  @endif


              </tr>
            </tbody>
          </table>

        </div>
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">INSPECCIONES</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Mostrar Tabla">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar Tabla">
                  <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="panel-body">
                  <button type="button" class="btn btn-success btn-xs" name="button" data-toggle="modal" data-target="#md_nueva_inspeccion" onclick="modalNuevaInspeccion()" >Nueva Inspección</button>
                </div>
                <table class="table table-bordered table-hover" id="tabla_inspecciones">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Detalle</th>
                      <th>Fecha Inspección</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $cont=0;
                    @endphp
                    @foreach ($inspecciones as $key => $value)
                      @php
                        $cont++;
                      @endphp
                      <tr>
                        <td>
                          {{$cont}}
                        </td>
                        <td>
                          {{$value->observaciones}}
                        </td>
                        <td>{{$value->created_at}}</td>
                        <td>
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#md_detalle_inspecion" onclick="verDetalleInspeccion({{$value->idinspeccion_colmena}});" name="button" >Ver Detalle</button>
                          <button type="button" class="btn btn-info btn-xs"  data-toggle="modal" data-target="#md_nueva_inspeccion" onclick="abrirModalEditarInspeccion({{$value->idinspeccion_colmena}})" name="button">Editar Inspección</button>
                          <button type="button" class="btn btn-danger btn-xs" onclick="eliminarInspeccion({{$value->idinspeccion_colmena}});" name="button">Eliminar Inspección</button>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              </div>
      <script src="{{ asset('js/colmenas.js') }}" defer></script>
      @endsection
