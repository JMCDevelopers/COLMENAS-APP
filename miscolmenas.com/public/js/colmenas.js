$(document).ready(function(){
  $("#colmena").addClass("active");
  //GenerarPaginado();
  GenerarPaginadoInspecciones();
});


function ConsultarPorApiario(id){

  if(id==null){
    var url='/colmena/';
  }else{
    var url='/colmena/'+id;
  }
  window.location.href=url;
}



var incluye_reina=false;
/**
* Muestra un mensaje de advertencia si el navegador no soporta Drag & Drop. (En Windows no lo soportan ni IE ni Safari)
**/
function comprobarnavegador() {
  if(
    (navigator.userAgent.toLowerCase().indexOf('msie ') > -1) ||
    ((navigator.userAgent.toLowerCase().indexOf('safari') > -1) && (navigator.userAgent.toLowerCase().indexOf('chrome') == -1)))
    {
      alert("Tu navegador no soporta correctamente las funciones Drag & Drop de HTML5. Prueba con otro navegador.");
    }

  }


  // cuadrito arratrable
  contador = 0; // Variable global para tener poder poner un id unico a cada elemento cuando se clona.
  function start(e) {
    e.dataTransfer.effecAllowed = 'move'; // Define el efecto como mover (Es el por defecto)
    e.dataTransfer.setData("Data", e.target.id); // Coje el elemento que se va a mover
    e.dataTransfer.setDragImage(e.target, 0, 0); // Define la imagen que se vera al ser arrastrado el elemento y por donde se coje el elemento que se va a mover (el raton aparece en la esquina sup_izq con 0,0)
    e.target.style.opacity = '0.4';
  }

  function end(e){
    e.target.style.opacity = ''; // Pone la opacidad del elemento a 1
    e.dataTransfer.clearData("Data");
  }

  function enter(e) {
    e.target.style.border = '3px dotted #555';
  }

  function leave(e) {
    e.target.style.border = '';
  }

  function over(e) {
    var elemArrastrable = e.dataTransfer.getData("Data"); // Elemento arrastrado
    var id = e.target.id; // Elemento sobre el que se arrastra

    // return false para que se pueda soltar
    if (id == 'cuadro1'){
      return false; // Cualquier elemento se puede soltar sobre el div destino 1
    }

    if ((id == 'cuadro2') && (elemArrastrable != 'arrastrable3')){
      return false; // En el cuadro2 se puede soltar cualquier elemento menos el elemento con id=arrastrable3
    }

    if (id == 'cuadro3')
    return false;

    if (id == 'papelera')
    return false; // Cualquier elemento se puede soltar en la papelera

  }


  /**
  *
  * Mueve el elemento
  *
  **/
  function drop(e){

    var elementoArrastrado = e.dataTransfer.getData("Data"); // Elemento arrastrado
    e.target.appendChild(document.getElementById(elementoArrastrado));
    e.target.style.border = '';  // Quita el borde
    tamContX = $('#'+e.target.id).width();
    tamContY = $('#'+e.target.id).height();

    tamElemX = $('#'+elementoArrastrado).width();
    tamElemY = $('#'+elementoArrastrado).height();

    posXCont = $('#'+e.target.id).position().left;
    posYCont = $('#'+e.target.id).position().top;

    // Posicion absoluta del raton
    x = e.layerX;
    y = e.layerY;

    // Si parte del elemento que se quiere mover se queda fuera se cambia las coordenadas para que no sea asi
    if (posXCont + tamContX <= x + tamElemX){
      x = posXCont + tamContX - tamElemX;
    }

    if (posYCont + tamContY <= y + tamElemY){
      y = posYCont + tamContY - tamElemY;
    }

    document.getElementById(elementoArrastrado).style.position = "absolute";
    document.getElementById(elementoArrastrado).style.left = x + "px";
    document.getElementById(elementoArrastrado).style.top = y + "px";
  }

  /**
  *
  * Elimina el elemento que se mueve
  *
  **/
  function eliminar(e){
    var elementoArrastrado = document.getElementById(e.dataTransfer.getData("Data")); // Elemento arrastrado
    elementoArrastrado.parentNode.removeChild(elementoArrastrado); // Elimina el elemento
    e.target.style.border = '';   // Quita el borde
  }

  /**
  *
  * Clona el elemento que se mueve
  *
  **/
  function clonar(e){
    var elementoArrastrado = document.getElementById(e.dataTransfer.getData("Data")); // Elemento arrastrado
    //  alert(elementoArrastrado.id);
    elementoArrastrado.style.opacity = ''; // Dejamos la opacidad a su estado anterior para copiar el elemento igual que era antes

    var elementoClonado = elementoArrastrado.cloneNode(true); // Se clona el elemento
    elementoClonado.id = ""+elementoArrastrado.id+""+"c";
    elementoClonado.classList.add("clon");
    //elementoClonado.class = "clon";// Se cambia el id porque tiene que ser unico
    contador += 1;
    elementoClonado.style.position = "static";  // Se posiciona de forma "normal" (Sino habria que cambiar las coordenadas de la posición)
    e.target.appendChild(elementoClonado); // Se añade el elemento clonado
    e.target.style.border = '';   // Quita el borde del "cuadro clonador"
  }


$(document).ready(function(){
  $("#codigo_seguimiento").keyup(function(){
    var parametros={
      "_token":$('input[name=_token]').val(),
      "codigo":$("#codigo_seguimiento").val(),
    };
    if($("#codigo_seguimiento").val()==""){
      $("#form-reinas").css('display','block');

    }
    $.ajax({
      type:'POST',
      url:'/codigo-seguimiento',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        var html="";
        console.log(data);
        if(data.identificador!=null){
          $("#form-reinas").css('display','none');
          $("#contenedor_detalle_reina").html("");

          html+="<div class='row'>";
          html+="<input id='idReinasVenta' type='text' value='"+data.idReinasVenta+"'>";
          html+="</div>";
          html+="<div class='row'>";
          html+="<span class='text-danger'>Identificador: </span><span>"+data.identificador+"</span>";
          html+="</div>";
          html+="<div class='row'>";
          html+="<span class='text-danger'>Raza: </span><span>"+data.raza+"</span>";
          html+="</div>";
          html+="<div class='row'>";
          html+="<span class='text-danger'>Fecha Nacimiento: </span><span>"+data.fecha_nacimiento+"</span>";
          html+="</div>";
          html+="<div class='row'>";
          html+="<span class='text-danger'>Historial: </span><span>"+data.historial+"</span>";
          html+="</div>";
          html+="<div class='row'>";
          html+="<span class='text-danger'>Procedencia: </span><span >"+data.criadero+"</span>";
          html+="</div>";
        }else{
          //$("#form-reinas").css('display','none');
          $("#contenedor_detalle_reina").html("");
          html+="<div class='alert alert-warning'>El codigo ingresado es incorrecto</div>";
        }
        $("#contenedor_detalle_reina").append(html);

      }
    });

  });
});

function incluyeReina(){
  if(incluye_reina){
    incluye_reina=false;
  }else{
    incluye_reina=true;
  }

}
// crud de colmena
 function agregarColmena(id){
   $("#id_apiario").val(id);
 }
// fin crud colmena
  function verDetalleReina(id){
    var parametros={
      "_token":$('input[name=_token]').val(),
      "id":id,
    };

    $.ajax({
      type:'POST',
      url:'/detalle-reina',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        armarDetalleReina(data);
      }
    });

  }

  function limpiarCamposColmenas(){
    $("#id_apiario").val("");
    $("#identificador_colmena").val("");
    $("#tipo_colmena").val("");
    $("#descripcion_colmena").val("");
    $("#origen_colmena").val("");
    $("#identificador_reina").val("");
    $("#raza").val("");
    $("#origen").val("");
    $("#fecha_nacimiento").val("");

  }
    function insertarColmena(){
      var id_apiario=$("#id_apiario").val();
      var identificador=$("#identificador_colmena").val().trim();
      var tipo=$("#tipo_colmena").val();
      var descripcion=$("#descripcion_colmena").val().trim();
      var origen=$("#origen_colmena").val();
      if(identificador==""){
        swal({
          title:"Alerta!!",
          text:"Ingrese un identificador a la  colmena",
          type:"warning",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Ok!",
        });
        return;
      }else if(tipo==""){
        swal({
          title:"Alerta!!",
          text:"Seleccione el tipo de colmena",
          type:"warning",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Ok!",
        });
        return;
      }else if(origen==""){
        swal({
          title:"Alerta!!",
          text:"Seleccione el orígen de la colmena",
          type:"warning",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Ok!",
        });
        return;
      }else{
        if(incluye_reina){
          if($("#idReinasVenta").val()==""){
            if($("#identificador_reina").val().trim()==""){
              swal({
                title:"Alerta!!",
                text:"Ingrese un identificador a la reina",
                type:"warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ok!",
              });
              return;
            }
          }

        }
        var parametros={
          "_token":$('input[name=_token]').val(),
          "identificador_colmena":identificador,
          "descripcion":descripcion,
          "tipo_colmena":tipo,
          "procedencia_colmena":origen,
          "apiario_idapiario":id_apiario,
        };
        $.ajax({
          type:'POST',
          url:'/insertar-colmena',
          async:true,
          cache:false,
          data:parametros,
          dataType:'json',
          success:function(data){

            if(incluye_reina){
              insertarReina(data);
            }else{
              limpiarCamposColmenas();
              swal({
                title:"Guardado!",
                text:"La colmena ha sido guardada correctamente.",
                type:"success"
              },
              function(){
                window.location.reload();
                });
            }
          }
        });

      }

    }


    function insertarReina(id_colmena){
        var idReinasVenta=$("#idReinasVenta").val();
        if(idReinasVenta){
          var parametros={
            "_token":$('input[name=_token]').val(),
            "id_colmena":id_colmena,
            "idReinasVenta":idReinasVenta,
          };
          $.ajax({
            type:'POST',
            url:'/insertar-reina-compra',
            async:true,
            cache:false,
            data:parametros,
            dataType:'json',
            success:function(data){
              if(data){
                limpiarCamposColmenas();
                swal({
                  title:"Guardado!",
                  text:"Registro creado correctamente.",
                  type:"success"
                },
                function(){
                  window.location.reload();
                  });
              }
            }
          });
        }else{
          var identificador=$("#identificador_reina").val().trim();
          var raza=$("#raza").val();
          var origen=$("#origen").val().trim();
          var fecha_nacimiento=$("#fecha_nacimiento").val();
          if(identificador=="")
          {
            swal({
              title:"Alerta!!",
              text:"Ingrese un identificador a la reina",
              type:"warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Ok!",
            });
            return;
          }

            var parametros={
              "_token":$('input[name=_token]').val(),
              "identificador_reina":identificador,
              "raza":raza,
              "origen_reina":origen,
              "fecha_nacimiento":fecha_nacimiento,
              "id_colmena":id_colmena,
            };
            $.ajax({
              type:'POST',
              url:'/crear-reina',
              async:true,
              cache:false,
              data:parametros,
              dataType:'json',
              success:function(data){
              //  console.log(data);
                if(data){
                  limpiarCamposColmenas();
                  swal({
                    title:"Guardado!",
                    text:"Registro guardado correctamente.",
                    type:"success"
                  },
                  function(){
                    window.location.reload();
                    });
                }
              }
            });



        }
    }


  function gestionColmena(id){
      window.location.href="/gestion-colmena/"+id;
  }


// editar identifocador de colmena
  function obtenerIdentificador(identificador){
    $("#identificador_colmena").val(identificador);
  }

  // descripcion
  function obtenerDescripcion(descripcion){
    $("#descripcion_colmena").val(descripcion);
  }
  function obtenerTipoColmena(tipo){
    $("#tipo_colmena").val(tipo);
  }
  function obtenerOrigenColmena(origen){
    $("#origen_colmena").val(origen);
  }

  function editarIdentificador(){
    var identificador=$("#identificador_colmena").val().trim();
    var id_colmena=$("#id_colmena").val();
    if(identificador==""){
      swal({
        title:"Alerta!!",
        text:"Ingrese un identificador",
        type:"warning",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Ok!",
      });
      return;
    }else{

      var parametros={
        "_token":$('input[name=_token]').val(),
        "identificador_colmena":identificador,
        "id_colmena":id_colmena,
      };

      $.ajax({
        type:'POST',
        url:'/editar-identificador-colmena',
        async:true,
        cache:false,
        data:parametros,
        dataType:'json',
        success:function(data){
        //  console.log(data);
          if(data){
            swal({
              title:"Guardado!",
              text:"La colmena ha sido ediatada correctamente.",
              type:"success"
            },
            function(){
              window.location.reload();
              });
          }
        }
      });
    }
  }


// editar descrición colmena
function editarDescripcion(){
  var descripcion=$("#descripcion_colmena").val().trim();
  var id_colmena=$("#id_colmena").val();
  if(descripcion==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese una descrición",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else{

    var parametros={
      "_token":$('input[name=_token]').val(),
      "descripcion_colmena":descripcion,
      "id_colmena":id_colmena,
    };

    $.ajax({
      type:'POST',
      url:'/editar-descripcion-colmena',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
      //  console.log(data);
        if(data){
          swal({
            title:"Guardado!",
            text:"La colmena ha sido ediatada correctamente.",
            type:"success"
          },
          function(){
            window.location.reload();
            });
        }
      }
    });
  }
}

// editar tipo colmena

function editarTipoColmena(){
  var tipo_colmena=$("#tipo_colmena").val().trim();
  var id_colmena=$("#id_colmena").val();
  if(tipo_colmena==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione tipo de colmena",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else{

    var parametros={
      "_token":$('input[name=_token]').val(),
      "tipo_colmena":tipo_colmena,
      "id_colmena":id_colmena,
    };

    $.ajax({
      type:'POST',
      url:'/editar-tipo-colmena',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
      //  console.log(data);
        if(data){
          swal({
            title:"Guardado!",
            text:"La colmena ha sido ediatada correctamente.",
            type:"success"
          },
          function(){
            window.location.reload();
            });
        }
      }
    });
  }
}

/// editar origen colmenas
function editarOrigenColmena(){
  var origen=$("#origen_colmena").val().trim();
  var id_colmena=$("#id_colmena").val();
  if(origen==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese un identificador",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else{

    var parametros={
      "_token":$('input[name=_token]').val(),
      "origen_colmena":origen,
      "id_colmena":id_colmena,
    };

    $.ajax({
      type:'POST',
      url:'/editar-origen-colmena',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
      //  console.log(data);
        if(data){
          swal({
            title:"Guardado!",
            text:"La colmena ha sido ediatada correctamente.",
            type:"success"
          },
          function(){
            window.location.reload();
            });
        }
      }
    });
  }
}

// eliminar colmena
function eliminarColmena(){

}
// eliminar reina

function eliminarReina(id_colmena){

  swal({
    title: "Eliminar Reina?",
    type: "warning",
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar!",
    closeOnConfirm: false
  },
  function(){
      var parametros={
        "_token":$('input[name=_token]').val(),
        "id_colmena":id_colmena,
      };
      $.ajax({
        type:'POST',
        url:'/eliminar-reina-colmena',
        async:true,
        cache:false,
        data:parametros,
        dataType:'json',
        success:function(data){
        //  console.log(data);
          if(data){
            swal({
              title:"OK!",
              text:"Reina Eliminada Correctamente",
              type:"success"
            },
            function(){
              window.location.reload();
              });
          }
        }
      });
  });
}


function insertarInspeccionColmena(id_colmena){
  var oberservacion_inspeccion=$("#obervaciones_inspeccion").val().trim();
  var fecha_inspeccion=$("#fecha_inspeccion").val();
  if(oberservacion_inspeccion==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese una obervación general a la inspección",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(fecha_inspeccion==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese la fecha de inspección",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else{
    $("#form_inspeccion").submit();
  }
}
// nueva inspecicon  modal
function modalNuevaInspeccion(){
  limpiarCamposInspeccion();
  $("#tipo_transaccion").val(1);
  $("#boton_inspeccion").html("Nueva Inspeccion");
}

// limpar campos
function limpiarCamposInspeccion(){
  $("#fecha_inspeccion").val("");
  $("#reina_vista").val("");
  $("#postura_reina").val("");
  $("#celdas_reales").val("");
  $("#cria").val("");
  $("#poblacion").val("");
  $("#temperamento").val("");
  $("#polen").val("");
  $("#miel").val("");
  $("#obervaciones_inspeccion").val("");
  $("#enfermedades").val("");
  $("#tratamientos_colmena").val("");
}
function abrirModalEditarInspeccion(id_inspeccion){
  var parametros={
    "_token":$('input[name=_token]').val(),
    "id_inspeccion":id_inspeccion,
  };
  $.ajax({
    type:'POST',
    url:'/get-inspeccion',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
        console.log(data);
        limpiarCamposInspeccion();
        $("#fecha_inspeccion").val(data.fecha_inspeccion);
        $("#reina_vista").val(data.reina);
        $("#postura_reina").val(data.postura);
        $("#celdas_reales").val(data.albeolos);
        $("#cria").val(data.crias_nacidas);
        $("#poblacion").val(data.fuerza_poblacion);
        $("#temperamento").val(data.temperamento_colmena);
        $("#polen").val(data.reservas_polen);
        $("#miel").val(data.reservas_miel);
        $("#obervaciones_inspeccion").val(data.observaciones);
        $("#enfermedades").val(data.enfermedad);
        $("#tratamientos_colmena").val(data.descripcion_enfermedades);
        $("#id_inspeccion").val(id_inspeccion);
        $("#tipo_transaccion").val(2);
        $("#boton_inspeccion").html("Editar Inspeccion");
    }
  });
}


function verDetalleInspeccion(id_inspeccion){
  var parametros={
    "_token":$('input[name=_token]').val(),
    "id_inspeccion":id_inspeccion,
  };
  $.ajax({
    type:'POST',
    url:'/get-inspeccion',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
        console.log(data);
        limpiarDatosDetalle();
        $("#fecha_detalle_inspeccion").append(data.fecha_inspeccion);
        $("#reina_detalle").append(data.reina);
        $("#postura_detalle").append(data.postura);
        $("#albeolos_detalle").append(data.albeolos);
        $("#cria_detalle").append(data.crias_nacidas);
        $("#poblacion_detalle").append(data.fuerza_poblacion);
        $("#temperamento_detalle").append(data.temperamento_colmena);
        $("#polen_detalle").append(data.reservas_polen);
        $("#miel_detalle").append(data.reservas_miel);
        $("#observaciones_detalle").append(data.observaciones);
        $("#enfermedad_detalle").append(data.enfermedad);
        $("#tratamientos_detalle").append(data.descripcion_enfermedades);
        var html="";
        html+="<img  width='600px'  height='300px' src='http://localhost:8080/miscolmenas.com/storage/app/public/"+data.imagen_inspeccion+"' />";
        $("#contenedor_imagen_detalle").append(html);
    }
  });
}
function limpiarDatosDetalle(){
  $("#fecha_detalle_inspeccion").html("");
  $("#reina_detalle").html("");
  $("#postura_detalle").html("");
  $("#albeolos_detalle").html("");
  $("#cria_detalle").html("");
  $("#poblacion_detalle").html("");
  $("#temperamento_detalle").html("");
  $("#polen_detalle").html("");
  $("#miel_detalle").html("");
  $("#observaciones_detalle").html("");
  $("#enfermedad_detalle").html("");
  $("#tratamientos_detalle").html("");
  $("#contenedor_imagen_detalle").html("");
}
function eliminarInspeccion(id_inspeccion){
  swal({
    title: "Eliminar Inspección?",
    text: "No podras volver a recuperar el registro!",
    type: "warning",
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Eliminar!",
    closeOnConfirm: false
  },
  function(){
    var parametros={
      "id_inspeccion":id_inspeccion,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/eliminar-inspeccion-colmena',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        //console.log(data);
        if(data){
          swal({
            title:"Eliminado!",
            text:"Inspección elimanda correctamente.",
            type:"success"
          },
          function(){
              window.location.reload();
            });
        }
      }
    });

  });
}


function GenerarPaginadoInspecciones(){

    $('#tabla_inspecciones').DataTable({
          language: {
                    processing: "Procesando...",
                    search: "Filtro",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de un total de _MAX_ registros)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "Ningún dato disponible en esta tabla",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "&uacute;ltimo"
                    }
                },
                aLengthMenu: [

            [5, 100, 200, -1],    //valor q utilizo en la propiedad iDisplayLength para asociar a una opcion
                          [5, 100, 200, "Todo"]  //opciones del select para la cant de registros a mostrar
                          ],
            iDisplayLength: 5,
            "bSort": true, //habilito el ordenar para todas las columnas
            "order": [],  //para que no ordene la primera columna por default
            "columnDefs": [{
                                  "targets"  : 'no-sort',
                                  "orderable": false,
                          }],
      } );
}


  function armarDetalleReina(reina){
    $("#contenedor_detalle_reina").html("");
    var html="";
    html+="<h3>Detalle Reina</h3>";
    html+="<div class='row'>";
    html+="<div class='col-lg-2'><label>Reina:</label></div>";
    html+="<div class='col-lg-6'>"+reina[0]['identificador_reina']+"</div>";
    html+="</div>";
    html+="<div class='row'>";
    html+="<div class='col-lg-2'><label>Descripción:</label></div>";
    html+="<div class='col-lg-6'>"+reina[0]['detalle']+"</div>";
    html+="</div>";
    html+="<div class='row'>";
    html+="<div class='col-lg-2'><label>Edad:</label></div>";
    html+="<div class='col-lg-6'>"+CalculaEdadReina(reina[0]['fecha_nacimiento'])+" <span class='text-danger'>Meses</span></div>";
    html+="</div>";
    html+="<div class='row'>";
    html+="<div class='col-lg-2'><label>Raza:</label></div>";
    html+="<div class='col-lg-6'>"+reina[0]['nombre']+"</div>";
    html+="</div>";
    $("#contenedor_detalle_reina").append(html);
  }

  function CalculaEdadReina(fecha_nacimiento){


    var parametros={
      "_token":$('input[name=_token]').val(),
      "fecha_nacimiento":fecha_nacimiento,
    };
    var result="";
    $.ajax({
      type:'POST',
      url:'/edad-reina',
      async:false,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        result= data;
        //return result;
      }
    });
    return result;
  }

  function guardarColmena(){
    var idexp=$("#idexposicion_solar").val();

    if($("#apiario_idapiario").val()==""){
      //alert('Seleccion un apiario');
      $("#apiario2").addClass('has-error');
      $("#apiario_alert").css('display','block');
      return;
    }
    else if($("#identificador_colmena").val()==""){
      swal('Ingrese un nombre de la colmena');
      return;
    }
    else if($("#num_marcos").val()==""){
      swal('Ingrese el nuemro de marcos');
      return;
    }
    else{

      var formulario=$("#frm_crear_colmena");

      $.ajax({
        type:'GET',
        url:'/insertar-colmena',
        async:false,
        cache:false,
        data:formulario.serialize(),
        dataType:'json',
        success:function(data){
          if(data=="denied"){

            swal({
              title: "Error",
              text: "Tu cuenta no permite crear mas colmenas, actualízala para continuar!",
              type: "warning",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Aceptar!",
              closeOnConfirm: false
            },
            function(){
                window.location.href="/account";
            });
          }else{
            InsertarComponentesColmena(data);
          }

        }
      });
    }

  }

  // metodo ajax para ingresar los componenets de la colmena
  function InsertarComponentesColmena(id){

    var id_clones=$(".clon");
    var cadena="";
    id_clones.each(function()
    {
      var id_mat = $(this).attr("id");
      id_mat=id_mat.substring(0,id_mat.length-1);
      cadena+=id_mat+"&&";
    });
    if(cadena!=""){
      cadena=cadena.substring(0,cadena.length-2);
    }

    var parametros={
      "id":id,
      "cadena":cadena,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/insertar-material',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data){

          swal({
            title:"Guardado!",
            text:"La colmena ha sido guardada correctamente.",
            type:"success"
          },
          function(){
            window.location.href="/colmena";
            });

        }
      }
    });

  }

  function ModalAsignarReina(id){
    $("#idcolmenas_reina").val(id);
    var parametros={
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'GET',
      url:'/obtener-reinas',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        $("#reinas_disponibles").html("");
        var html="";
        if(data.length>0){
          $("#reinas_disponibles").html("");

          html+="<label >Reinas Disponibles:</label>";
          html+="<select  id='idreina_disponible' onchange='verDetalleReina(this.value)'>";
          html+="<option value=''>--Seleccione una reina--</option>";
          for (var i = 0; i < data.length; i++) {
              html+="<option value='"+data[i]['idreinas']+"'>"+data[i]['identificador_reina']+"</option>";
          }
            html+="</select>";
            html+="<br>";
          html+="<button  class='btn btn-warning' onclick='asignarReina()' >Asignar Reina</button>";
        }else{
          html+="<span class='text-danger'>No hay reinas registradas disponibles</span>";
        }
        $("#reinas_disponibles").append(html);
      }
    });

    $("#modal_ingreso_reina").modal('show');
  }


  function registrarReina(){
    var identificador=$("#identificador_reina").val();
    if(identificador==""){
      swal("Ingrese un identificador para la reina!");
      return;
    }else{
      $("#frm_crear_reina").submit();
    }

  }
  function PruebaAlert(){
    swal(
      'En construccion!',
      'Estamos trabajando para darte un mejor servcio!',
      'success'
    )
  }

  function EliminarColmena(id){

    swal({
      title: "Eliminar Colmena?",
      text: "No podras volver a recuperar el registro!",
      type: "warning",
      cancelButtonText: 'Cancelar',
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Eliminar!",
      closeOnConfirm: false
    },
    function(){
      var parametros={
        "id":id,
        "_token":$('input[name=_token]').val(),
      };
      $.ajax({
        type:'POST',
        url:'/eliminar-colmena',
        async:true,
        cache:false,
        data:parametros,
        dataType:'json',
        success:function(data){
          if(data){
            swal({
              title:"Eliminado!",
              text:"La colmena ha sido elimanda correctamente.",
              type:"success"
            },
            function(){
                window.location.href="/colmena";
              });
          }
        }
      });

    });
  }

  function GenerarPaginado(){
    var id_tabla=$(".tbl");
    id_tabla.each(function(){
      var idtabla = $(this).attr("id");
      $('#'+idtabla).DataTable({
            language: {
                      processing: "Procesando...",
                      search: "Filtro",
                      lengthMenu: "Mostrar _MENU_ registros",
                      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                      infoFiltered: "(filtrado de un total de _MAX_ registros)",
                      infoPostFix: "",
                      loadingRecords: "Cargando...",
                      zeroRecords: "No se encontraron resultados",
                      emptyTable: "Ningún dato disponible en esta tabla",
                      paginate: {
                          first: "Primero",
                          previous: "Anterior",
                          next: "Siguiente",
                          last: "&uacute;ltimo"
                      }
                  },
                  aLengthMenu: [

              [10, 100, 200, -1],    //valor q utilizo en la propiedad iDisplayLength para asociar a una opcion
                            [10, 100, 200, "Todo"]  //opciones del select para la cant de registros a mostrar
                            ],
              iDisplayLength: 10,
              "bSort": true, //habilito el ordenar para todas las columnas
              "order": [],  //para que no ordene la primera columna por default
              "columnDefs": [{
                                    "targets"  : 'no-sort',
                                    "orderable": false,
                            }],

        } );
    });

  }

  function EditarColmena(id){
    var url='editar-colmena/'+id;
    window.location.href=url;
  }


  //mostrar componentes de la colmena
  function VerComponentes(idcolmena){
    var parametros={
      "idcolmena":idcolmena,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/obtener-componentes',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        $("#contenedor_componentes").html("");
        var html="";
        if(data.length>0){
          for (var i = 0; i < data.length; i++) {
            html+="<div class='row'>";
            html+="<img src='"+data[i]['url_imagen']+"' alt=''>";
            html+="<span class='text-danger'>"+data[i]['nombre_componente']+"</span>";
            html+="</div>";
          }
        }else{
          html+="<span class='text-danger'>No se econtraron componentes</span>";
        }
        $("#contenedor_componentes").append(html);
        $("#modal_componentes").modal('show');

      }
    });

  }

  // detalle de la colmena
  function DetalleColmena(id){

    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/obtener-detalle-colmenas',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data.length>0){
          limpiar();
          $("#identificador").append(data[0]['identificador_colmena']);
          $("#fecha_creacion").append(data[0]['created_at']);
          $("#descripción").append(data[0]['descripcion']);
          $("#apiario_colmena").append(data[0]['nombre_apiario']);
          $("#tipo_colmena").append(data[0]['nombre_tipo']);
          $("#origen_colmena").append(data[0]['nombre_fuente']);
          $("#fuerza").append(data[0]['fuerza']);
          var rn=data[0]['identificador_reina'];
          if(rn=="" || rn==null){
            rn="<span class='text-danger'>Sin asignar</span>";
          }
          $("#reina_colmena").append(rn);
          getDetailsInspection(id);
          $("#modal_detalle_colmena").modal('show');
        }
      }});

  }

  function limpiar(){
    $("#identificador").html("");
    $("#fecha_creacion").html("");
    $("#descripción").html("");
    $("#apiario_colmena").html("");
    $("#descripcion").html("");
    $("#tipo_colmena").html("");
    $("#origen_colmena").html("");
    $("#fuerza").html("");
    $("#reina_colmena").html("");
    $("#reza_reina").html("");
    $("#fecha_inspeccion_detalle").html("");
    $("#colmena_detalle").html("");
    $("#apiario_detalle").html("");
    $("#reina_detalle").html("");
    $("#postura").html("");
    $("#cria_sellada").html("");
    $("#cria_nacida").html("");
    $("#fuerza_poblacion").html("");
    $("#temperamento").html("");
    $("#marcos").html("");
    $("#polen").html("");
    $("#miel").html("");
    $("#albeolos").html("");
    $("#olor").html("");
    $("#material").html("");
    $("#clima").html("");
    $("#descripcion_clima").html("");
    $("#observaciones").html("");
    $("#contenedor_imagenes_inspeccion").html("");
    $("#contenedor_condiciones").html("");
    $("#contenedor_enfermedades").html("");
    $("#contenedor_tratamientos").html("");
    $("#contenedor_alimentos").html("");
  }

  function getDetailsInspection(id){
    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/obtener-detalle-inspeccion',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data['fecha_inspeccion']!=null){
          $("#fecha_inspeccion_detalle").append(data['fecha_inspeccion']);
          $("#reina_detalle").append(data['reina']);
          $("#postura").append(data['postura']);
          $("#cria_sellada").append(data['cria']);
          $("#cria_nacida").append(data['crias_nacidas']);
          $("#fuerza_poblacion").append(data['fuerza_poblacion']);
          $("#temperamento").append(data['temperamento_colmena']);
          $("#marcos").append(data['numero_marcos']);
          $("#polen").append(data['reservas_polen']);
          $("#miel").append(data['reservas_miel']);
          $("#albeolos").append(data['albeolos']);
          $("#olor").append(data['olor']);
          $("#material").append(data['material']);
          $("#clima").append(data['clima']);
          $("#descripcion_clima").append(data['descripcion_clima']);
          $("#observaciones").append(data['observaciones']);
          var idInspeccion=data['idinspeccion_colmena'];
          obtenerCondicionesInspeccion(idInspeccion);
          obtenerEnfermedadesInspeccion(idInspeccion);
          obtenerTratamientosInspeccion(idInspeccion);
          obtenerAlimentos(idInspeccion);
          obtenerImagenesInspeccion(idInspeccion);
        }else{
          limpiar();
          $("#inspeccion_detalles").html("");
          var html="<span class='text-danger'>No se ha realizado una inspección a la colmena</span>";
          $("#inspeccion_detalles").append(html);
        }

      }
    });
  }

  function obtenerCondicionesInspeccion(id){
    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/detalle-condiciones',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data.length){
          $("#contenedor_condiciones").html("");
          var html="";
          for (var i = 0; i < data.length; i++) {

            html+="<span> *"+data[i]['nombre_condicion']+"</span>";

          }
          $("#contenedor_condiciones").append(html);
        }

      }
    });

  }
  function obtenerEnfermedadesInspeccion(id){
    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/detalle-enfermedades',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data.length){
          $("#contenedor_enfermedades").html("");
          var html="";
          for (var i = 0; i < data.length; i++) {

            html+="<span class='text-danger'> *"+data[i]['nombre_enfermedad']+"</span>";

          }
          $("#contenedor_enfermedades").append(html);
        }

      }
    });

  }

  //metodo ajax para obteneer los  Tratamientos
  function obtenerTratamientosInspeccion(id){
    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/detalle-tratamientos',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data.length){
          $("#contenedor_tratamientos").html("");
          var html="";
          for (var i = 0; i < data.length; i++) {
            html+="<span class='text-danger'> *"+data[i]['nombre_tratamiento']+"</span>";
          }
          $("#contenedor_tratamientos").append(html);
        }
      }
    });

  }
  //alimentos proporcionados ajax

  function obtenerAlimentos(id){
    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/detalle-alimentos',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data.length){
          $("#contenedor_alimentos").html("");
          var html="";
          for (var i = 0; i < data.length; i++) {
            html+="<span class='text-success'> *"+data[i]['nombre_alimento']+"</span>";
          }
          $("#contenedor_alimentos").append(html);
        }
      }
    });
  }


function ingresar(){
  incluye_reina=true;
}
  //obtener imagen de inspeccion
  function obtenerImagenesInspeccion(id){
    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/detalle-imagenes',
      async:false,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){

$("#contenedor_imagenes_inspeccion").html("");
        if(!jQuery.isEmptyObject(data)){

          var html="";
          if(data[0]['url_imagen_inspeccion']!=""){
                html+="<div class='item active'>";
                html+="<img width='900px'  height='500px' src='/storage/"+data[0]['url_imagen_inspeccion']+"' alt='First slide'>";
                html+="<div class='carousel-caption'>Imagen Inspección 1</div>";
                html+="</div>";
          }
          if(data[1]['url_imagen_inspeccion']!=""){
                html+="<div class='item'>";
                html+="<img width='900px'  height='500px'  src='/storage/"+data[1]['url_imagen_inspeccion']+"' alt='Second slide'>";
                html+="<div class='carousel-caption'>Imagen Inspección 2</div>";
                html+="</div>";
          }
          if(data[2]['url_imagen_inspeccion']!=""){
                html+="<div class='item'>";
                html+="<img width='900px'  height='500px' src='/storage/"+data[2]['url_imagen_inspeccion']+"' alt='Third slide'>";
                html+="<div class='carousel-caption'>Imagen Inspección 3</div>";
                html+="</div>";
          }


        }else{

          html+="<div class='item active'>";
          html+="<img width='900px'  height='500px' src='#' alt='First slide'>";
          html+="<div class='carousel-caption'>Imagen Inspección 1</div>";
          html+="</div>";

          html+="<div class='item'>";
          html+="<img width='900px'  height='500px'  src='#' alt='Second slide'>";
          html+="<div class='carousel-caption'>Imagen Inspección 2</div>";
          html+="</div>";

          html+="<div class='item'>";
          html+="<img width='900px'  height='500px' src='#' alt='Third slide'>";
          html+="<div class='carousel-caption'>Imagen Inspección 3</div>";
          html+="</div>";
        }
        $("#contenedor_imagenes_inspeccion").append(html);
      }
    });
  }

  function nuevaInspeccionColmena(id){
    var url='nueva-inspeccion/'+id+'/m';
    window.location.href=url;
  }

  function gestionEventos(id){
    $("#id_colmenas").val(id);
    obtenerEventos(id);
    $("#modal_eventos_colmena").modal('show');
  }

  function guardarEvento(){
    var descripcion=$("#descripcion_evento").val();
    if(descripcion==""){
      swal("Ingrese la descripción del evento!");
      return;
    }

    var id=$("#id_colmenas").val();
    var fecha_evento=$("#fecha_evento").val();
    var parametros={
      "descripcion":descripcion,
      "idcolmenas":id,
      "fecha_evento":fecha_evento,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'GET',
      url:'/guardar-evento',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){

        if(data){
          swal("Evento registrado correctamente!", "", "success");
          $("#descripcion_evento").val("");
          obtenerEventos(id);
        }else{
          swal("Error: No se guardo el evento!");
        }

      }
    });
  }

function obtenerEventos(id){
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/eventos',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      if(data.length>0){
        $("#contenedor_eventos").html("");
        var html="";
        html+="<table class='table table-bordered table-hover' id='tabla_eventos'>";
        html+="<thead>";
        html+="<th>#</th>";
        html+="<th>Descripción evento</th>";
        html+="<th>Fecha Evento</th>";
        html+="<th>Acciones</th>";
        html+="</thead>";
        html+="<tbody>";
        for (var i = 0; i < data.length; i++) {
          var con=i+1;
          html+="<tr>";
          html+="<td>"+con+"</td>";
          html+="<td>"+data[i]['descripcion_evento']+"</td>";
          html+="<td>"+data[i]['fecha_evento']+"</td>";
          html+="<td><button onclick='eliminarEvento("+data[i]['ideventos']+")' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></button></td>";
          html+="</tr>";
        }
        html+="</tbody>";
        html+="</table>";
        $("#contenedor_eventos").append(html);
        GenerarPaginadoEventos();
      }else{
          $("#contenedor_eventos").html("");
      }
    }
  });
}

function GenerarPaginadoEventos(){


    $('#tabla_eventos').DataTable({
          language: {
                    processing: "Procesando...",
                    search: "Filtro",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de un total de _MAX_ registros)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "Ningún dato disponible en esta tabla",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "&uacute;ltimo"
                    }
                },
                aLengthMenu: [

            [5, 100, 200, -1],    //valor q utilizo en la propiedad iDisplayLength para asociar a una opcion
                          [5, 100, 200, "Todo"]  //opciones del select para la cant de registros a mostrar
                          ],
            iDisplayLength: 5,
            "bSort": true, //habilito el ordenar para todas las columnas
            "order": [],  //para que no ordene la primera columna por default
            "columnDefs": [{
                                  "targets"  : 'no-sort',
                                  "orderable": false,
                          }],

      } );
}

function eliminarEvento(id){

  var idcolmena=$("#id_colmenas").val();
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/eliminar-eventos',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      swal("Evento eliminado correctamente!", "", "success");
      obtenerEventos(idcolmena);
    }
  });
}

function LiberarReina(idreina){
  var idreina=$("#id_reina").val();
  var idcolmena= $("#id_colmena_reina").val();

  var parametros={
    "_token":$('input[name=_token]').val(),
    "idcolmena":idcolmena,
    "idreina":idreina,
  };
  var result="";
  $.ajax({
    type:'POST',
    url:'/liberar-reina',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      window.location.reload();
    }
  });

}
function EliminarReina(){
  var idreina=$("#id_reina").val();

  var parametros={
    "_token":$('input[name=_token]').val(),
    "idreina":idreina,
  };
  var result="";
  $.ajax({
    type:'POST',
    url:'/delete-reina',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      window.location.reload();
    }
  });
}

function asignarReina(){
  var idreina=$("#idreina_disponible").val();
  var idcolmena=$("#idcolmenas_reina").val();
  var parametros={
    "_token":$('input[name=_token]').val(),
    "idcolmena":idcolmena,
    "idreina":idreina,
  };

  $.ajax({
    type:'POST',
    url:'/asigna-reina-colmena',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      if(data){
        $("#modal_ingreso_reina").modal('hide');
        swal("Reina Asignada Correctamente!", "", "success");
        window.location.reload();
      }
    }
  });

}
function modalDetalleReina(id,idcolmena){
  $("#id_reina").val(id);
  $("#id_colmena_reina").val(idcolmena);
  var parametros={
    "_token":$('input[name=_token]').val(),
    "id":id,
  };

  $.ajax({
    type:'POST',
    url:'/detalle-reina',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      armarDetalleReina2(data);
    }
  });
  $("#modal_gestion_reina").modal('show');
}

function armarDetalleReina2(reina){
  $("#contenedor_detalle").html("");
  var html="";
  html+="<div class='row'>";
  html+="<div class='col-lg-2'><label>Reina:</label></div>";
  html+="<div class='col-lg-6'>"+reina[0]['identificador_reina']+"</div>";
  html+="</div>";
  html+="<div class='row'>";
  html+="<div class='col-lg-2'><label>Descripción:</label></div>";
  html+="<div class='col-lg-6'>"+reina[0]['detalle']+"</div>";
  html+="</div>";
  html+="<div class='row'>";
  html+="<div class='col-lg-2'><label>Edad:</label></div>";
  html+="<div class='col-lg-6'>"+CalculaEdadReina(reina[0]['fecha_nacimiento'])+" <span class='text-danger'>Meses</span></div>";
  html+="</div>";
  html+="<div class='row'>";
  html+="<div class='col-lg-2'><label>Raza:</label></div>";
  html+="<div class='col-lg-6'>"+reina[0]['nombre']+"</div>";
  html+="</div>";
  $("#contenedor_detalle").append(html);
}

// genera codigo qr
function generarCodigosQr(){
  var url='code';
  window.open(url, '_blank');
}
