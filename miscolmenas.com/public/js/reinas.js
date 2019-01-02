$(document).ready(function(){
  $("#reina").addClass("active");
  ObtenerReinas();
  ObtenerReinasInstaladas();
});
function ObtenerReinas(){

  $.ajax({
    type:'POST',
    url:'/tabla-reinas',
    async:true,
    cache:false,
    data: {'_token': $('input[name=_token]').val()},
    dataType:'html',
    success:function(data){
      $("#contenedor_tabla_reinas").html("");
      $("#contenedor_tabla_reinas").append(data);

    }
  });
}
function ObtenerReinasInstaladas(){


  $.ajax({
    type:'POST',
    url:'/tabla-reinas-instaladas',
    async:true,
    cache:false,
    data: {'_token': $('input[name=_token]').val()},
    dataType:'html',
    success:function(data){

      $("#contenedor_tabla_inst").html("");
      $("#contenedor_tabla_inst").append(data);

    }
  });
}
function ModalEliminarReina(id){

  swal({
    title: "Eliminar Reina?",
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

      "idreina":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/delete-reina',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        if(data){
          swal({
            title:"Eliminado!",
            text:"Reina elimanda correctamente.",
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
function EliminarReina(){

  $("#frm_eliminar").submit();
}
function EditarReina(id){
  var url='/editar-reina/'+id
  window.location.href=url;
}
function VerDetalleReina(id){
  var parametros={
    "_token":$('input[name=_token]').val(),
    "id":id,
  };

  $.ajax({
    type:'POST',
    url:'/detalle-reina',
    async:true,
    data:parametros,
    dataType:'json',
    success:function(data){
      LimpiarCampos();
      $("#titulo").append("REINA "+data[0]['identificador_reina']);
      $("#fecha_nacimiento").append(data[0]['fecha_nacimiento']);
      $("#descripcion_reina").append(data[0]['detalle']);
      $("#origen_reina").append(data[0]['procedencia']);
      var fecha=calcularEdad(data[0]['fecha_nacimiento']);
      $("#edad_reina").append(fecha+" meses");
      $("#instalado").append(data[0]['instalado']);
      $("#estado").append(data[0]['tipo']);
      $("#raza").append(data[0]['nombre']);
      $("#modal_detalle_reina").modal('show');

    }
  });
}
//limpiar campos de detalle reinas
function LimpiarCampos(){
  $("#fecha_nacimiento").html("");
  $("#titulo").html("");
  $("#descripcion_reina").html("");
  $("#origen_reina").html("");
  $("#edad_reina").html("");
  $("#instalado").html("");
  $("#estado").html("");
  $("#raza").html("");
}

//obtener edad reina
function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}
