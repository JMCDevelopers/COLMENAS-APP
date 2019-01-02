$(document).ready(function(){
  $("#estadistica").addClass("active");
});

function imprimirReporteColmenas(){
  var divToPrint=document.getElementById('body_reporte');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

function generarReporteColmenas(){
  var reporte=$("#tipo_reporte_colmena").val();
  var titulo_reporte="";
  if(reporte==1){
    titulo_reporte="REPORTE DE COLMENAS ENFERMAS";
  }
  if(reporte==2){
    titulo_reporte="REPORTE DE COLMENAS SIN REINAS";
  }
  if(reporte==3){
    titulo_reporte="REPORTE DE COLMENAS CON REINAS VIEJAS";
  }
  if(reporte==4){
    titulo_reporte="REPORTE DE TODAS LAS COLMENAS";
  }
  var parametros={
    "tipo":reporte,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/reporte-colmenas',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      $("#imprimir").css('display','block');
    //  $("#tabla_reporte").css('display','block');
      $("#num_registros").html("");
      $("#num_registros").append("Número de registros = "+data.length);
      $("#nombre_reporte").html("");
      $("#nombre_reporte").append(titulo_reporte);
      console.log(data);
      construirTabla(data);
    }
  });

}
function construirTabla(data){
  $("#detalle_reporte_colmenas").html("");
  var html="";
  for (var i = 0; i < data.length; i++) {
    html+="<tr>";
    html+="<td>"+data[i].colmena+"</td>";
    html+="<td>"+data[i].apiario+"</td>";
    html+="<td>"+data[i].provincia+"</td>";
    html+="<td>"+data[i].observacion+"</td>";
    html+="<td>"+data[i].enfermedades+"</td>";
    html+="</tr>";
  }
  $("#detalle_reporte_colmenas").append(html);

}
