@extends('layouts/dashboard')
@section('contenido')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('inspeccion')}}"><i class="glyphicon glyphicon-hand-left"></i>Inspeccones</a></li>
      <li class="active">Editar Inspección</li>
    </ol>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Editar Inspección</h3>
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
                <form class="" action="" id="frm_inspeccion" method="post">


                <h2 for="apiario">COLMENA: <span class="text-danger">{{$colmena->identificador_colmena}}</span></h2>
                <input type="hidden" name="idcolmenas" value="{{$colmena->idcolmenas}}">
                <input type="hidden" id="idinspeccion_colmena_editar" name="idinspeccion_colmena" value="{{$inspeccion->idinspeccion_colmena}}">
                <button type="button" class="btn btn-warning" name="button" onclick="actualizarInspeccion()" >Editar Inspección</button>
              </div>
              <div class="form-group">
                <label for="fecha">Fecha de inspección</label>
                <input type="date" name="fecha_inspeccion" value="{{$inspeccion->fecha_inspeccion}}">
              </div>
              <div class="panel panel-primary">
                <label for="">  Primera Vista</label>
                <div class="form-group">
                  <label for="fecha">Reina:</label>
                  <select class="" name="reina">
                    @php
                      $style_rn1="";
                      $style_rn2="";
                    @endphp
                    @if ($inspeccion->reina=="SI")
                      @php
                        $style_rn1="selected";
                      @endphp
                    @elseif($inspeccion->reina=="NO")
                      @php
                        $style_rn2="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_rn1}} value="SI">SI</option>
                    <option {{$style_rn2}} value="NO">NO</option>
                  </select>
                  <label for="fecha">Postura:</label>
                  <select class="" name="postura">
                    @php
                      $style_ps1="";
                      $style_ps2="";
                    @endphp
                    @if ($inspeccion->postura=="SI")
                      @php
                        $style_ps1="selected";
                      @endphp
                    @elseif($inspeccion->postura=="NO")
                      @php
                        $style_ps2="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_ps1}} value="SI">SI</option>
                    <option {{$style_ps2}} value="NO">NO</option>
                  </select>
                  <label for="fecha">Cria Sellada:</label>
                  <select class="" name="cria">
                    @php
                      $style_cr1="";
                      $style_cr2="";
                    @endphp
                    @if ($inspeccion->cria=="SI")
                      @php
                        $style_cr1="selected";
                      @endphp
                    @elseif($inspeccion->cria=="NO")
                      @php
                        $style_cr2="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_cr1}} value="SI">SI</option>
                    <option {{$style_cr2}} value="NO">NO</option>
                  </select>
                  <label for="fecha">Crias nacidas:</label>
                  <select class="" name="crias_nacidas">
                    @php
                      $style_crn1="";
                      $style_crn2="";
                    @endphp
                    @if ($inspeccion->crias_nacidas=="SI")
                      @php
                        $style_crn1="selected";
                      @endphp
                    @elseif($inspeccion->crias_nacidas=="NO")
                      @php
                        $style_crn2="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_crn1}} value="SI">SI</option>
                    <option {{$style_crn2}} value="NO">NO</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="">Fuerza de población:</label>
                <select class="" name="fuerza_poblacion">
                  @php
                    $style_fr1="";
                    $style_fr2="";
                    $style_fr3="";
                    $style_fr4="";
                    $style_fr5="";
                    $style_fr6="";
                  @endphp
                  @if ($inspeccion->fuerza_poblacion=="10%--punto de deceso")
                    @php
                      $style_fr1="selected";
                    @endphp
                  @elseif($inspeccion->fuerza_poblacion=="25%--Critico")
                    @php
                      $style_fr2="selected";
                    @endphp
                  @elseif($inspeccion->fuerza_poblacion=="50%--Debil")
                    @php
                      $style_fr3="selected";
                    @endphp
                  @elseif($inspeccion->fuerza_poblacion=="75%--Moderado")
                    @php
                      $style_fr4="selected";
                    @endphp
                  @elseif($inspeccion->fuerza_poblacion=="100%--Fuerte")
                    @php
                      $style_fr5="selected";
                    @endphp
                  @elseif($inspeccion->fuerza_poblacion=="++%--Sobrepoblado")
                    @php
                      $style_fr6="selected";
                    @endphp
                  @endif
                  <option value="">--Elija un opción</option>
                  <option {{$style_fr1}}  style="background:red;" value="10%--punto de deceso">10%--punto de deceso</option>
                  <option {{$style_fr2}} style="background:#FA8258;" value="25%--Critico">25%--Critico</option>
                  <option {{$style_fr3}} style="background:#FF8000;" value="50%--Debil">50%--Debil</option>
                  <option {{$style_fr4}} style="background:#80FF00;" value="75%--Moderado">75%--Moderado</option>
                  <option {{$style_fr5}} style="background:#04B404;" value="100%--Fuerte">100%--Fuerte</option>
                  <option {{$style_fr6}} style="background:#FE2E2E;"  value="++%--Sobrepoblado">++%--Sobrepoblado</option>
                </select>
                <label for="">Temperamento Colmena::</label>
                <select class="" name="temperamento_colmena">
                    @php
                      $style_tem1="";
                      $style_tem2="";
                      $style_tem3="";
                    @endphp
                    @if ($inspeccion->temperamento_colmena=="Tranquilo")
                      @php
                        $style_tem1="selected";
                      @endphp
                    @elseif($inspeccion->temperamento_colmena=="Nervioso")
                      @php
                        $style_tem1="selected";
                      @endphp
                    @elseif($inspeccion->temperamento_colmena=="Agresivo")
                      @php
                        $style_tem3="selected";
                      @endphp
                    @endif

                  <option value="">--Elija un opción</option>
                  <option {{$style_tem1}} value="Tranquilo">Tranquilo</option>
                  <option {{$style_tem2}} value="Nervioso">Nervioso</option>
                  <option {{$style_tem3}} value="Agresivo">Agresivo</option>
                </select>
                <label for="">Número de Marcos:</label>
                <input type="number" name="numero_marcos"  value="{{$inspeccion->numero_marcos}}">
              </div>
              <div class="form-group">
                <label for="">Observaciones:</label>
                <textarea  class="form-control" name="observaciones" rows="3" cols="80" placeholder="Ingrese observaciones de la inspección">{{$inspeccion->observaciones}}</textarea>
              </div>
            </div>
          </div>

          <!--clima-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Clima Apiario Inspeccionado -- <span class="text-danger">Llenar esta información solo si lo considera necesario!</span>
              </div>
            </div>
            <div class="panel-title">
              <div class="form-group">
                <label for="">Condiciones:</label>
                <select class="" name="clima">
                  <option value="">--Elija una opción--</option>
                  @foreach ($exposicion as $key => $value)
                    @if ($value->nombre_exposicion==$inspeccion->clima)
                      <option selected value="{{$value->nombre_exposicion}}">{{$value->nombre_exposicion}}</option>
                    @else
                      <option value="{{$value->nombre_exposicion}}">{{$value->nombre_exposicion}}</option>
                    @endif

                  @endforeach
                  <option value=""></option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Descripción:</label>
                <textarea  placeholder="Descripción del clima" class="form-control" name="descripcion_clima" rows="3" cols="80">{{$inspeccion->descripcion_clima}}</textarea>
              </div>
            </div>
          </div>
          <!--condiciones de la colmena-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Condiciones de la colmena
              </div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                  <label for="">Reservas de polen</label>
                  <select class="" name="reservas_polen">
                    @php
                      $style_p1="";
                      $style_p2="";
                      $style_p3="";
                    @endphp
                    @if ($inspeccion->reservas_polen=="Bajo")
                      @php
                        $style_p1="selected";
                      @endphp
                    @elseif($inspeccion->reservas_polen=="Medio")
                      @php
                        $style_p2="selected";
                      @endphp
                    @elseif($inspeccion->reservas_polen=="Alto")
                      @php
                        $style_p3="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_p1}} value="Bajo">Bajo</option>
                    <option {{$style_p2}} value="Medio">Medio</option>
                    <option {{$style_p3}} value="Alto">Alto</option>
                  </select>
                  <label for="">Reservas de Miel:</label>
                  <select class="" name="reservas_miel">
                    @php
                      $style_m1="";
                      $style_m2="";
                      $style_m3="";
                    @endphp
                    @if ($inspeccion->reservas_miel=="Bajo")
                      @php
                        $style_m1="selected";
                      @endphp
                    @elseif($inspeccion->reservas_miel=="Medio")
                      @php
                        $style_m2="selected";
                      @endphp
                    @elseif($inspeccion->reservas_miel=="Alto")
                      @php
                        $style_m3="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_m1}} value="Bajo">Bajo</option>
                    <option {{$style_m2}} value="Medio">Medio</option>
                    <option {{$style_m3}} value="Alto">Alto</option>
                  </select>
                  <label for="">Celdas reales/ Albeolos:</label>
                  <select class="" name="albeolos">
                    @php
                      $style_al1="";
                      $style_al2="";
                    @endphp
                    @if ($inspeccion->albeolos=="Si")
                      @php
                        $style_al1="selected";
                      @endphp
                    @elseif($inspeccion->albeolos=="No")
                      @php
                        $style_al2="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_al1}} value="Si">Si</option>
                    <option {{$style_al2}} value="No">No</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Olor:</label>
                  <select class="" name="olor">
                    @php
                      $style_ol1="";
                      $style_ol2="";
                      $style_ol3="";
                    @endphp
                    @if ($inspeccion->olor=="Normal")
                      @php
                        $style_ol1="selected";
                      @endphp
                    @elseif($inspeccion->olor=="Falta")
                      @php
                        $style_ol2="selected";
                      @endphp
                    @elseif($inspeccion->olor=="Fermentado")
                      @php
                        $style_ol3="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_ol1}} value="Normal">Normal</option>
                    <option {{$style_ol2}} value="Falta">Falta</option>
                    <option {{$style_ol3}} value="Fermentado">Fermentado</option>
                  </select>
                  <label for="">Condiciones del material:</label>
                  <select class="" name="material">
                    @php
                      $style_mat1="";
                      $style_mat2="";
                    @endphp
                    @if ($inspeccion->material=="Bueno")
                      @php
                        $style_mat1="selected";
                      @endphp
                    @elseif($inspeccion->material=="Dañano")
                      @php
                        $style_mat2="selected";
                      @endphp
                    @endif
                    <option value="">--Elija una opción</option>
                    <option {{$style_mat1}} value="Bueno">Bueno</option>
                    <option {{$style_mat2}} value="Dañano">Dañano</option>
                  </select>
                </div>
                </form>

                <!--fin form-->

                <div class="panel panel-primary">
                  <span class="text-danger">Seleccione las condiciones de la colmena</span>
                  <div class="panel-body">
                    <label for="">Necesita Refuerzo:</label>
                    <input type="checkbox" class="cn" id="Necesita refuerzo">
                    <label for="">___Propoleo Excesivo:</label>
                    <input type="checkbox" class="cn" id="Propoleo excesivo">
                    <label for="">___Abjas Muertas:</label>
                    <input type="checkbox" class="cn" id="Abejas Muertas">
                    <label for="">___Exceso de Humedad:</label>
                    <input type="checkbox" class="cn" id="Exceso de humedad">
                  </div>
                </div>
            </div>
          </div>
          <!--enfermedades-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Enfermedades
              </div>
            </div>
            <div class="panel-body">
              <div class="form-group">
                <div class="panel panel-primary">
                  <span class="text-danger">Seleccione enfermedades de la colmena</span>
                  <div class="panel-body">
                    <div class="col-lg-6">

                      <div class="form-group">
                      <label for="">__Loque americano</label>
                      <input type="checkbox" class="enf" id="Loque americano">
                    </div>
                    <div class="form-group">

                      <label for="">___Loque europeo</label>
                      <input type="checkbox" class="enf" id="Loque europeo">
                    </div>
                    <div class="form-group">
                      <label for="">___Chalkbrood</label>
                      <input type="checkbox" class="enf" id="Chalkbrood">
                    </div>
                    <div class="form-group">
                      <label for="">___Nosema</label>
                      <input type="checkbox" class="enf" id="Nosema">
                    </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="">___Garapatas</label>
                        <input type="checkbox" class="enf" id="Garapatas">
                      </div>
                      <div class="form-group">
                        <label for="">___Acaro Varroa</label>
                        <input type="checkbox" class="enf" id="Acaro Varroa">
                      </div>
                      <div class="form-group">
                        <label for="">Otros</label>
                        <textarea class="form-control" id="otros_enfermedades" rows="2" cols="80" placeholder="Describa alguna otra enfermedad"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--tratamientos-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Tratamientos
              </div>
            </div>
            <div class="panel-body">
              <div class="panel panel-primary">

                <span class="text-danger">Seleccione los tratamientos aplicados en la colmena</span>
                <div class="panel-body">
                  <div class="col-lg-6">
                    <div class="form-group">
                    <label for="">__Api-Life VAR:</label>
                    <input type="checkbox" class="tra" id="Api-Life VAR<">
                  </div>
                  <div class="form-group">
                    <label for="">___Apistan:</label>
                    <input type="checkbox" class="tra" id="Apistan">
                  </div>
                  <div class="form-group">
                    <label for="">___Ácido fórmico:</label>
                    <input type="checkbox" class="tra" id="Ácido fórmico">
                  </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">___Terramycina:</label>
                      <input type="checkbox" class="tra" id="Terramycina">
                    </div>
                      <div class="form-group">
                        <label for="">___Ácido oxálico:</label>
                        <input type="checkbox" class="tra" id="Ácido oxálico">
                      </div>
                      <div class="form-group">
                        <label for="">___Azúcar en polvo + Oxitraciclina:</label>
                        <input type="checkbox"  class="tra" id="Azúcar en polvo + Oxitraciclina">
                      </div>
                      <div class="form-group">
                        <label for="">Otros:</label>
                        <textarea class="form-control" id="otros_tratamientos" rows="2" cols="80" placeholder="Otros tratamientos"></textarea>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Alimentacion-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Alientación
              </div>
            </div>
            <div class="panel-body">
              <div class="panel panel-primary">

                <span class="text-danger">Seleccione tipo de alimento proporcionados</span>
                <div class="panel-body">
                  @foreach ($alimentacion as $key => $value)
                    @if ($value->nombre_alimento=="Otros")
                      <div class="form-group">
                        <label for="">__{{$value->nombre_alimento}}:</label>
                        <input class="otro_alimento" type="text" id="otro_alimento" value="" placeholder="Otros alimentos">
                      </div>
                    @else
                      <div class="form-group col-lg-3">
                        <label for="">__{{$value->nombre_alimento}}:</label>
                        <input class="al" type="checkbox" id="{{$value->nombre_alimento}}" value="">
                      </div>
                    @endif

                  @endforeach
                </div>

              </div>
            </div>
          </div>
          <!--imagens inspeccion-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                Imeagenes Inspección
              </div>
            </div>
            <div class="panel-body">
              <div class="panel panel-primary">

                <span class="text-danger">Ingresar Imagenes Inspeccion.</span>
                <div class="panel-body">

                    <form class="" action="{{route('guardar_imagen_inspeccion')}}" method="post" id="frm_imagenes" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group col-lg-4">
                        <label for="">Imagen 1:</label>
                      <input type="file" name="imagen_uno"  >
                      <input type="hidden" name="id_apiario_img" id="id_apiario_img" value="">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="">Imagen 2:</label>
                      <input type="file" name="imagen_dos"  >
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="">Imagen 3:</label>
                    <input type="file" name="imagen_tres"  >
                    </div>
                    </form>


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
                    <form class="" action="" method="post" id="frm_tareas">
                      <div class="form-group">
                      <label for="">Establesca la fecha para la realizacion la tarea:</label>
                      <input type="hidden" name="estado" value="0">
                      <input type="hidden" name="tipo" value="inspeccion">
                      <input type="hidden" name="idcuenta_usuario" value="{{$cuenta_usuario}}">
                      <input type="date" name="fecha_realizacion" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                    <label for="">Descripción Tarea:</label>
                    <textarea id="tarea" rows="3" cols="80" placeholder="Describa la tarea" name="descripcion_tarea"></textarea>
                  </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <button type="button" class="btn btn-warning" name="button" onclick="actualizarInspeccion()" >Editar Inspección</button>
          </div>

        </div>
      </div>
    <script src="{{ asset('js/nueva_inspeccion.js') }}" defer></script>

@endsection
