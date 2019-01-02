$(document).ready(function(){
  $("#inspeccion").addClass("active");

obtenerCondicionesInspeccion();
});

function obtenerCondicionesInspeccion(){
  var id=$("#idinspeccion_colmena_editar").val();

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
        for (var i = 0; i < data.length; i++) {
        var condicion=data[i]['nombre_condicion'];
        $("#Necesita refuerzo").prop('checked',true);
        }
      }
    }
  });

}
