$(document).ready(function(){
  $("#negocio").addClass("active");

});

function generarReporte(){
  var fecha_inicio= $("#fecha_desde").val();
  var fecha_fin=$("#fecha_hasta").val();
  if(fecha_inicio==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione fecha desde",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(fecha_fin==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione fecha hasta",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else{

      var startDate = $('#fecha_desde').val().replace(/-/g,'/');
      var endDate = $('#fecha_hasta').val().replace(/-/g,'/');

      if(startDate > endDate){
        swal({
          title:"Alerta!!",
          text:"Rango de fecha incorrecto",
          type:"warning",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Ok!",
        });
        return;
        }
    var parametros={
      "_token":$('input[name=_token]').val(),
      "desde":fecha_inicio,
      "hasta":fecha_fin,
    };
    $.ajax({
      type:'POST',
      url:'/reporte-generado',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        $("#contendor_reporte").html("");
        var html="";
        html+="<table>";
        html+="<tr>";
        html+="<th>VENTAS: </th>";
        html+="<td>"+data.ventas+"</td>";
        html+="</tr>";
        html+="<tr>";
        html+="<th>COMPRAS: </th>";
        html+="<td>"+data.compras+"</td>";
        html+="</tr>";
        html+="<tr>";
        html+="<th>RENTABILIDAD: </th>";
        html+="<td>"+data.ganancias+"</td>";
        html+="</tr>";
        html+="</table>";
        $("#contendor_reporte").append(html);
        console.log(data);
      }
    });
  }
}
