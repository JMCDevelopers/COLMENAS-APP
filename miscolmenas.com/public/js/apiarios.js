$(document).ready(function(){
  $("#apiario").addClass("active");
  ObtenerTablaApiarios();
});

function iniciar(){
var boton=document.getElementById('obtener');
boton.addEventListener('click', obtener, false);
}

function obtener(){
  navigator.geolocation.getCurrentPosition(mostrar, gestionarErrores);
}

function mostrar(posicion){
var dato1=posicion.coords.latitude;
var dato2=posicion.coords.longitude;
$("#latitud").val("");
$("#latitud").val(dato1);
$("#longitud").val("");
$("#longitud").val(dato2);
}

function gestionarErrores(error){

alert('Error: '+error.code+' '+error.message+ '\n\nPor favor compruebe que está conectado '+

'a internet y habilite la opción permitir compartir ubicación física');

}

window.addEventListener('load', iniciar, false);

// metodos crud apiarios
function guardarApiario(){
  var apiario=$("#identificador").val().trim();
  var direccion=$("#direccion").val().trim();
  var provincia=$("#provincia").val().trim();
  var descripcion=$("#descripcion").val().trim();
  var establecimiento=$("#establecimiento").val().trim();
  if(apiario==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese un nombre o identificador de apiario",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(direccion==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese una dirección",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
  }else if(provincia==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione una provincia",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(descripcion==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese una descripción",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(establecimiento==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione un establecimiento",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else {
      $("#form_apiario").submit();
  }

}

// fin metodos crud


function ObtenerTablaApiarios(){
  $.ajax({
    type:'POST',
    url:'/tabla',
    data: {'_token': $('input[name=_token]').val()},
    dataType:'html',
    success:function(data){

      $("#contenedor_tabla").html("");
      $("#contenedor_tabla").append(data);
    }
  });

}

// abrir midal de iungreso apiario nuevo
function AbrirModalnuevo(){
  $("#nuevo").modal('show');
}


function ModalEliminarApiario(id){
//  $("#id_apiario").val(id);
  //$("#modal_eliminar").modal('show');
  swal({
    title: "Eliminar Apiario?",
    text: "No podras volver a recuperar el registro!",
    type: "warning",
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Eliminar!",
    closeOnConfirm: false
  },
  function(){
    EliminarApiario(id);
  });
}

function EliminarApiario(id){


  var parametros={
    "_token":$('input[name=_token]').val(),
    "idapiario":id,
  };

  $.ajax({
    type:'POST',
    url:'/delete',
    async:true,
    data:parametros,
    dataType:'json',
    success:function(data){

      if(data){
        swal({
          title:"Eliminado!",
          text:"Apiario elimando correctamente.",
          type:"success"
        },
        function(){
            window.location.reload();
          });
      }else{
        swal({
          title: "Error",
          text: "No se puede eliminar, Apiario asociado a colmenas!",
          type: "warning",
          cancelButtonText: 'Cancelar',
          showCancelButton: true,
          confirmButtonClass: "btn-info",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
          window.location.reload();
        });

      }

    }
  });
}
function EditarApiario(id){

  var url='/edit/'+id
  window.location.href=url;
}


function VerDetalleApiario(id){
  var parametros={
    "_token":$('input[name=_token]').val(),
    "id":id,
  };

  $.ajax({
    type:'POST',
    url:'/detalle',
    async:true,
    data:parametros,
    dataType:'json',
    success:function(data){
      LimpiarCampos();
      $("#titulo").append("DETALLE DE APIARIO : "+data[0]['nombre_apiario']);
      $("#fecha_creacion").append(data[0]['created_at']);
      $("#numero_colmenas").append(0);
      var res=ObtenerProvincia(data[0]['provincia_idprovincia']);
      $("#provincia").append(res);
      //ObtenerMapa(id);
      obtenerUltimaInspeccion(id);
      $("#modal_detalle_apiario").modal('show');
    }
  });
}

function obtenerUltimaInspeccion(id){
  var parametros={
    "_token":$('input[name=_token]').val(),
    "idapiario":id,
  };
  $.ajax({
    type:'get',
    url:'/inspeccion-details',
    async:false,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      limpiarDetalle();
        $("#fecha_inspeccion").append(data['fecha_inspeccion']);
        $("#detalle_inspeccion").append(data['detalle_inspeccion']);
        $("#contenedor_imagen_inspeccion").html("");
      var html="";
      if(data['imagen1']!=null || data['imagen1']!=""){

            html+="<img width='900px'  height='500px' src='http://localhost:8080/miscolmenas.com/storage/app/public/"+data['imagen1']+"' alt='First slide'>";
            html+="<div class=''>Imagen Inspección 1</div>";

      }
      if(jQuery.isEmptyObject(data)){
        $("#contenedor_imagen_inspeccion").html("<span class='text-danger'>No existen datos</span>");
      }else{
        $("#contenedor_imagen_inspeccion").append(html);
      }
    }
  });
}
function limpiarDetalle(){
  $("#fecha_inspeccion").html("");
  $("#detalle_inspeccion").html("");
  $("#clima").html("");
  $("#mantenimiento").html("");
}
//obtener provincia desde el controladopr
function ObtenerProvincia(id){
  var parametros={
    "_token":$('input[name=_token]').val(),
    "id":id,
  };
  var result="";
  $.ajax({
    type:'POST',
    url:'/provincia',
    async:false,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      result=data[0]['nombre_provincia'];
    }
  });
  return result;
}
//limpiar campos de detalle apiarios
function LimpiarCampos(){
  $("#nombre_apiario").html("");
  $("#fecha_creacion").html("");
  $("#numero_colmenas").html("");
  $("#provincia").html("");
  $("#titulo").html("");
}
//obtiene mapara de apiario
function ObtenerMapa(id){
  $('#mapa_apiario').attr('src','http://localhost:8000/map/'+id+'');
}
//inspeccinar aprio
function InspeccionApiario(id){
  var url='inspeccion-apiario/'+id;
  window.location.href=url;
}
//
function GuardarInspeccionApiario(){
  $("#frm_inspeccion_apiario").submit();
}
