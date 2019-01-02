$(document).ready(function(){
  $("#inspeccion").addClass("active");
  GenerarPaginado();
});


function obtenerColmenas(id){
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'post',
    url:'/colmenas-apiario',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){

      var html="";
      html+='<label for="apiario">Colmena:</label>';
      html+='<select class="" name="idcolmena" id="idcolmena">'
        html+='<option value="">--Seleccione colmena--</option>';
        if(data.length>0){
          for (var i = 0; i < data.length; i++) {
            html+='<option value="'+data[i]['idcolmenas']+'">'+data[i]['identificador_colmena']+'</option>';
          }
        }
      html+='</select>';
      $("#contenedor_select").html("");
      $("#contenedor_select").append(html);
    }
  });
}

function nuevaInspeccion(){
  var id=$("#idcolmena").val();
  if(id==""){
    swal('Seleccione una colmena!');
    return;
  }
  var url='nueva-inspeccion/'+id+'/n';
  window.location.href=url;
}

function GenerarPaginado(){
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
}

function eliminarInspeccion(id){
  swal({
    title: "Eliminar Inspeccion?",
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
      type:'post',
      url:'/eliminar-inspeccion',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data){
          swal({
            title:"Eliminado!",
            text:"Inspeccion eliminada correctamente!",
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

function verDeatalleInspeccion(id){
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/detalle-inspeccion',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      limpiarCampos();
      $("#fecha_inspeccion_detalle").append(data[0]['fecha_inspeccion']);
      $("#colmena_detalle").append(data[0]['identificador_colmena']);
      $("#apiario_detalle").append(data[0]['nombre_apiario']);
      $("#reina_detalle").append(data[0]['reina']);
      $("#postura").append(data[0]['postura']);
      $("#cria_sellada").append(data[0]['cria']);
      $("#cria_nacida").append(data[0]['crias_nacidas']);
      $("#fuerza_poblacion").append(data[0]['fuerza_poblacion']);
      $("#temperamento").append(data[0]['temperamento_colmena']);
      $("#marcos").append(data[0]['numero_marcos']);
      $("#polen").append(data[0]['reservas_polen']);
      $("#miel").append(data[0]['reservas_miel']);
      $("#albeolos").append(data[0]['albeolos']);
      $("#olor").append(data[0]['olor']);
      $("#material").append(data[0]['material']);
      $("#clima").append(data[0]['clima']);
      $("#descripcion_clima").append(data[0]['descripcion_clima']);
      $("#observaciones").append(data[0]['observaciones']);
      obtenerCondicionesInspeccion(id);
      obtenerEnfermedadesInspeccion(id);
      obtenerTratamientosInspeccion(id);
      obtenerAlimentos(id);
      obtenerImagenesInspeccion(id);
    }
  });
  $("#modal_detalle_inspeccion").modal('show');

}

function limpiarCampos(){
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
        if(!jQuery.isEmptyObject(data[0]['url_imagen_inspeccion'])){
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

function editarInspeccion(id){
    var url='editar-inspeccion/'+id;
    window.location.href=url;
}
