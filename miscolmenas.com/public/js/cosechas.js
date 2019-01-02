$(document).ready(function(){
  $("#cosecha").addClass("active");
  GenerarPaginado();
  var idcos=$("#idcos").val();
  if(idcos==undefined){

  }else{
    ObtenerColmenasApiario()
  }

});


function ObtenerColmenasApiario(){

  var id=$("#apiario_id").val();
  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
  };

  $.ajax({
    type:'POST',
    url:'/colmenas-apiario',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      if(data.length){
        $("#contenedor_colmenas").html("");
        var html="";
        for (var i = 0; i < data.length; i++) {
          var id=data[i]['idcolmenas']
          html+="<input checked type='checkbox' class='col' id='"+id+"' ><label>"+data[i]['identificador_colmena']+"</label>";
        }
        $("#contenedor_colmenas").append(html);
      }
    }
  });
}


function GuardarCosecha(){
  var fecha=$("#fecha_cosecha").val().trim();
  var producto=$("#nombre_producto").val().trim();
  var cantidad=$("#cantidad").val().trim();
  var unidad=$("#unidad_medida").val().trim();
  var descripcion=$("#descripcion").val().trim();
  var idapiario=$("#apiario_id").val().trim();
  if(fecha==""){
    alert("ingrese fecha");
    return;
  }else if(producto==""){
    alert("ingrese producto");
    return;
  }else if(cantidad==""){
    alert('ingrese cantidad');
    return;
  }else if(unidad==""){
    alert('ingrese unidad');
    return;
  }else if(descripcion==""){
    alert('ingrese descripcion');
    return;
  }else if(idapiario==""){
    alert('ingrese apiario');
    return;
  }


  $("#frm_cosecha").submit();
  /*
  $.ajax({
    type:'get',
    url:'/guardar-cosecha',
    async:true,
    cache:false,
    data:form.serialize(),
    dataType:'json',
    success:function(data){
      if(data){
        alert('ok');
      }
    }
  });*/

}


  function GenerarPaginado(){
      $('#tabla_cosechas').DataTable({
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

  function EliminarCosecha(id){
    swal({
      title: "Eliminar Cosecha?",
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
        type:'get',
        url:'/eliminar-cosecha',
        async:true,
        cache:false,
        data:parametros,
        dataType:'json',
        success:function(data){
          if(data){
            swal({
              title:"Eliminado!",
              text:"La cosecha ha sido eliminada correctamente.",
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

  function EditarCosecha(id){
    var url='editar-cosecha/'+id;
    window.location.href=url;
  }

//editar cpsecha
function ActualizarCosecha(){

  var fecha=$("#fecha_cosecha").val().trim();
  var producto=$("#nombre_producto").val().trim();
  var cantidad=$("#cantidad").val().trim();
  var unidad=$("#unidad_medida").val().trim();
  var descripcion=$("#descripcion").val().trim();
  var idapiario=$("#apiario_id").val().trim();


  if(fecha==""){
    alert("ingrese fecha");
    return;
  }else if(producto==""){
    alert("ingrese producto");
    return;
  }else if(cantidad==""){
    alert('ingrese cantidad');
    return;
  }else if(unidad==""){
    alert('ingrese unidad');
    return;
  }else if(descripcion==""){
    alert('ingrese descripcion');
    return;
  }else if(idapiario==""){
    alert('ingrese apiario');
    return;
  }
  $("#frm_cosecha_editar").submit();

}
//detalle de cosechas
function detalleCosecha(id){

  var parametros={
    "id":id,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/detalle-cosecha',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      if(data.length>0){
        limparCampos();
        $("#fecha_cosecha").html(data[0]['fecha_cosecha']);
        $("#producto").html(data[0]['producto']);
        $("#descripcion").html(data[0]['descripcion']);
        $("#cantidad").html(data[0]['cantidad']);
        $("#unidad").html(data[0]['unidad_medida']);
        $("#imagen_cosecha").attr("src","http://localhost:8080/miscolmenas.com/storage/app/public/"+data[0]['url_imagenl']);
        $("#apiario_detalle").html(data[0]['nombre_apiario']);
        $("#direccion_apiario").html(data[0]['direccion']);
        $("#descripcion_apiario").html(data[0]['descripcion']);
        //var array=data[0]['colmenas_cosechadas'].split("&&");
        //GenerarColmenasCosechadas(array);
        $("#modal_detalle_cosecha").modal('show');
      }


    }
  });
}

function GenerarColmenasCosechadas(colmenas){
  $("#colmenas_cosechadas").html("");
  var html="";
  html+="<div class='form-group'>";
  html+="<h5>Colmenas Cosechadas</h5>"
  for (var i = 0; i < colmenas.length; i++) {
    var result=""
    var parametros={
      "id":colmenas[i],
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/colmena-cosecha',
      async:false,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){
        result=data['identificador_colmena'];

      }
      });
      html+="</div>";
      html+="<div class='text-success'>"+result+"</div>";
  }
$("#colmenas_cosechadas").append(html);
}

function limparCampos(){
  $("#fecha_cosecha").html("");
  $("#producto").html("");
  $("#descripcion").html("");
  $("#cantidad").html("");
  $("#unidad").html("");
}
