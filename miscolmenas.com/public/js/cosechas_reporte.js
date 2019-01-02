$(document).ready(function(){
  $("#estadistica").addClass("active");
});


function generarReporteCosechas(){
  var fecha_inicio= $("#fecha_desde").val();
  var fecha_fin=$("#fecha_hasta").val();
  var producto=$("#producto").val();
  if(producto==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione un producto",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(fecha_inicio==""){
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
      "producto":producto,
    };
    $.ajax({
      type:'POST',
      url:'/reporte-cosechas',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        //alert("resp");
        $("#imprimir").css('display','block');
        console.log(data);
        construirTabla(data);
      }
    });
  }
}

function construirTabla(data){
  $("#detalle_reporte_cosechas").html("");
  var html="";
  for (var i = 0; i < data.length; i++) {
    html+="<tr>";
    html+="<td>"+data[i].apiario+"</td>";
    html+="<td>"+data[i].provincia+"</td>";
    html+="<td>"+data[i].producto+"</td>";
    html+="<td>"+data[i].cantidad+"</td>";
    html+="<td>"+data[i].unidad_medida+"</td>";
    html+="<td>"+data[i].fecha_cosecha+"</td>";
    html+="</tr>";
  }
  $("#detalle_reporte_cosechas").append(html);

}

function imprimirReporteCosechas(){
  var divToPrint=document.getElementById('body_reporte');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
