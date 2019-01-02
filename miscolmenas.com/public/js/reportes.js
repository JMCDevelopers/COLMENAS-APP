$(document).ready(function(){
  $("#estadistica").addClass("active");
  getInspeccionesEstadistica();
});

  var objeto=obtenerMesesActuales();
	var barChartData = {

		labels : objeto.meses,
		datasets : [

			{
				fillColor : "rgba(255, 153, 0 ,1)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data :objeto.valores,
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("barChart").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}


function obtenerMesesActuales(){


  var d = new Date();
  var n = d.getMonth();
  //return n+1;
  //alert(n+1);

  var months = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Novimbre","Diciembre"];
  var monthsNow=[];
  for (var i = 0; i < n+1; i++) {
    monthsNow[i]=months[i];
    //Porcentaje[i]=i+2;
  }
  var object={
    "meses":monthsNow,
    "valores":getPercentajeValueMonths()
  };
  console.log(object);
  return object;
}


function getPercentajeValueMonths(){
  var porcentajes=[];
  var d = new Date();
  var n = d.getMonth();
  var meses=["2019-01","2019-02","2019-03","2019-04","2019-05","2019-06","2019-07","2019-08","2019-09","2019-10","2019-11","2019-12"];
  var monthsNow=[];
  for (var i = 0; i < n+1; i++) {
    monthsNow[i]=meses[i];
  }


  for (var j = 0; j < monthsNow.length; j++) {
    var result=0;
    var parametros={
        "_token":$('input[name=_token]').val(),
        "monthsNow":monthsNow[j],
      };


    $.ajax({
      type:'GET',
      url:'/porcentajes-cosechas',
      async:false,
      cache:false,
      data: parametros,
      dataType:'json',
      success:function(data){
        //alert(data);
        result=data;
      }
    });
    porcentajes[j]=result;
  }
  console.log(porcentajes);
  return porcentajes;

}

function getInspeccionesEstadistica(){
  var objeto=getInformacion();
  var barChartData = {

    labels : objeto.informacion,
    datasets : [

      {
        fillColor : "rgba(255, 153, 0 ,1)",
        strokeColor : "rgba(151,187,205,0.8)",
        highlightFill : "rgba(151,187,205,0.75)",
        highlightStroke : "rgba(151,187,205,1)",
        data :objeto.valores,
      }
    ]

  }
  var ctx = document.getElementById("infoIngresada").getContext("2d");
  window.myBar = new Chart(ctx).Bar(barChartData, {
    responsive : true
  });
}

function getInformacion(){
  getInfoData();
  var informacion = ["Colmenas","Cosechas","Inspecciones","Tareas","Apiarios"];
  var object={
    "informacion":informacion,
    "valores":getInfoData()
  };
  console.log(object);
  return object;
}

function getInfoData(){
  var porcentaje=[];
  var parametros={
      "_token":$('input[name=_token]').val(),
    };


  $.ajax({
    type:'GET',
    url:'/estadistica',
    async:false,
    cache:false,
    data: parametros,
    dataType:'json',
    success:function(data){
      porcentaje=[data.colmena,data.cosecha,data.inspeccion,data.tarea,data.apiario]
    }
  });

  console.log(porcentaje);
  return porcentaje;
}

function reporteColmenas(){
  var url='reportes';
  window.open(url, '_blank');
}
function reporteCosechas(){
  var url='reporte-cosechas';
  window.open(url, '_blank');
}

function reporteInspecciones(){
  var url='reporte-inspecciones';
  window.open(url, '_blank');
}

function reporteReinas(){
  var url='reporte-reinas';
  window.open(url, '_blank');
}
function generarCodigosQr(){
  var url='code';
  window.open(url, '_blank');
}
