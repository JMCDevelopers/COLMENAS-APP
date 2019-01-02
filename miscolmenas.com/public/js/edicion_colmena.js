$(document).ready(function(){

  var idreina=$("#id_reina").val();

  if(idreina!=""){
    verDetalleReina(idreina);
  }else{
    CrearSelectReinas();
  }
});




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

function armarDetalleReina(reina){
  var idreina=$("#id_reina").val();
  $("#contenedor_detalle_reina").html("");
  var html="";
  if(idreina!=""){
  html+="<input type='hidden' name='idreinas' value='"+reina[0]['idreinas']+"'/>";
  }
  html+="<h3>Detalle Reina</h3>";
  html+="<hr>";
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

  if(idreina!=""){
      html+="<div><button type='button' class='btn btn-link' onclick='EliminarReina("+reina[0]['idreinas']+")'>Eliminar reina</button><button type='button' class='btn btn-link' onclick='LiberarReina("+reina[0]['idreinas']+")'>Liberar reina</button></div>";
  }

  $("#contenedor_detalle_reina").append(html);
}

function EliminarReina(idreina){
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
      if(data){
        $("#id_reina").val("");
        CrearSelectReinas();
      }
    }
  });
}
function LiberarReina(idreina){
  var idcolmena=$("#idcolmenas").val();
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
      if(data){
      $("#id_reina").val("");
        CrearSelectReinas();
      }
    }
  });

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
    }
  });
  return result;
}


function CrearSelectReinas(){
  var parametros={
    "_token":$('input[name=_token]').val(),
  };

  $.ajax({
    type:'POST',
    url:'/reinas-disponibles',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      $("#contenedor_detalle_reina").html("");
      $("#contenedor_select").html("");
      var html="";
      html+="<div class='form-group'>";
      html+="<label for=''>Reinas Disponibles</label>";
      html+="<select class='' name='idreinas' id='idreinas' onchange='verDetalleReina(this.value);'>";
      html+="<option value=''>-Seleccione una reina-</option>";
      for (var i = 0; i < data.length; i++) {
        html+="<option value='"+data[i]['idreinas']+"'>"+data[i]['identificador_reina']+"</option>";
      }
      html+="</select>";
      html+="</div>";
      $("#contenedor_select").append(html);
    }
  });
}

function EditarColmena(){
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

    var formulario=$("#frm_editar_colmena");

    $.ajax({
      type:'GET',
      url:'/actualizar-colmena',
      async:false,
      cache:false,
      data:formulario.serialize(),
      dataType:'json',
      success:function(data){
        ActualizarComponentesColmena(data);
      }
    });
  }

}

// metodo ajax para ingresar los componenets de la colmena
function ActualizarComponentesColmena(idcolmena){
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
    "idcolmena":idcolmena,
    "cadena":cadena,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/actualizar-componentes',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      if(data){
      
        swal({
          title:"Actualizado!",
          text:"La colmena ha sido actualizada correctamente.",
          type:"success"
        },
        function(){
          window.location.href="/colmena";
          });

      }
    }
  });

}
