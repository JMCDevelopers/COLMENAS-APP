$(document).ready(function(){
  $("#inspeccion").addClass("active");

});


function GuardarInspeccion(){

  var form=$("#frm_inspeccion");
  $.ajax({
    type:'get',
    url:'/guardar-inspeccion',
    async:true,
    cache:false,
    data:form.serialize(),
    dataType:'json',
    success:function(data){

      guardarCondiciones(data);
      guardarEnfermedades(data);
      guardarTratamientos(data);
      guardarAliemtacionColmena(data);
      guardarTarea();
      guardarImagenesInspeccion(data);
    }
  });

}


function guardarCondiciones(id){
  var condiciones = $(".cn");
  var cadena="";
  condiciones.each(function()
  {
    if( $(this).prop('checked') )
    {
      var idcodiciones = $(this).attr("id");
      cadena+=idcodiciones+"&&";
    }
  });

//alert(cadena);
  if(cadena!="")
  {
    cadena=cadena.substring(0,cadena.length-2);

    var parametros={
      "id":id,
      "_token":$('input[name=_token]').val(),
      "cadena":cadena,
    };
    $.ajax({
      type:'post',
      url:'/guardar-condiciones',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){

      }
    });
  }
}


function guardarEnfermedades(id){
  var otros=$("#otros_enfermedades").val().trim();

  var enfermedades = $(".enf");
  var cadena="";
  enfermedades.each(function()
  {
    if( $(this).prop('checked') )
    {
      var idenfermedades = $(this).attr("id");
      cadena+=idenfermedades+"&&";
    }
  });
//alert(cadena);
  if(cadena!="")
  {
    cadena=cadena.substring(0,cadena.length-2);
  }
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
    "cadena":cadena,
    "otros":otros,
  };
  $.ajax({
    type:'post',
    url:'/guardar-enfermedades',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){

    }
  });
}

function guardarTratamientos(id){
  var otros=$("#otros_tratamientos").val().trim();

  var tratamientos = $(".tra");
  var cadena="";
  tratamientos.each(function()
  {
    if( $(this).prop('checked') )
    {
      var idtratamientos = $(this).attr("id");
      cadena+=idtratamientos+"&&";
    }
  });
//alert(cadena);
  if(cadena!="")
  {
    cadena=cadena.substring(0,cadena.length-2);
  }
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
    "cadena":cadena,
    "otros":otros,
  };
  $.ajax({
    type:'post',
    url:'/guardar-tratamientos',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){

    }
  });
}

function guardarAliemtacionColmena(id){
  var otros=$("#otro_alimento").val().trim();

  var alimentos = $(".al");
  var cadena="";
  alimentos.each(function()
  {
    if( $(this).prop('checked') )
    {
      var idalimentos = $(this).attr("id");
      cadena+=idalimentos+"&&";
    }
  });
//alert(cadena);
  if(cadena!="")
  {
    cadena=cadena.substring(0,cadena.length-2);
  }
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
    "cadena":cadena,
    "otros":otros,
  };
  $.ajax({
    type:'post',
    url:'/guardar-alimento',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){

    }
  });
}


function guardarTarea(){
  var form=$("#frm_tareas");
  $.ajax({
    type:'get',
    url:'/guardar-tarea',
    async:true,
    cache:false,
    data:form.serialize(),
    dataType:'json',
    success:function(data){

    }
  });
}

function guardarImagenesInspeccion(id){

  $("#id_apiario_img").val(id);
  var form=$("#frm_imagenes");

  form.submit();
  /*
  $.ajax({
    type:'post',
    url:'/guardar-imagen-inspeccion',
    cache:false,
    contentType: false,
    processData: false,
    data:formData,
    success:function(data){
      alert(data);
    }
  });
  */
}

function actualizarInspeccion(){
  var form=$("#frm_inspeccion");
  $.ajax({
    type:'get',
    url:'/actualizar-inspeccion',
    async:true,
    cache:false,
    data:form.serialize(),
    dataType:'json',
    success:function(data){

      guardarCondiciones(data);
      guardarEnfermedades(data);
      guardarTratamientos(data);
      guardarAliemtacionColmena(data);
      guardarTarea();
      guardarImagenesInspeccion(data);
    }
  });
}
