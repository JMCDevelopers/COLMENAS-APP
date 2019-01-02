$(document).ready(function(){
  $("#negocio").addClass("active");
  GenerarPaginadoCompras();
});
var cont=0;
var objItems=new Object();
var total_compra=0;
var total_impuesto=0;
$("#total").append(total_compra);

function nuevaCompra(){
  $("#nueva_compra").modal("show");
}


function generarItemsCompra(){
  var producto=$("#producto").val();
  var costo=$("#costo").val();
  var cantidad=$("#cantidad").val();
  if(producto==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese un producto",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(costo==""){

    swal({
      title:"Alerta!!",
      text:"Ingrese el costo",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(cantidad==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese una cantidad",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }

  generarTablaItems(producto,costo,cantidad);
  $("#producto").val("");
  $("#costo").val("");
  $("#cantidad").val("");
}

function generarTablaItems(producto,costo,cantidad){
  var total=0;


  total=parseInt(cantidad) * parseFloat(costo);
  var html="";
  html+="<tr id='"+cont+"'>"
  html+="<td>"+producto+"</td>";
  html+="<td>"+costo+"</td>";
  html+="<td>"+cantidad+"</td>";
  html+="<td>"+parseFloat(total).toFixed(2)+"</td>";
  html+="<td><button type='button' onclick='eliminarItem("+cont+");'>Quitar</button></td>";
  html+="</tr>";
  $("#contenedor_compra").append(html);

  objItems[cont]={
    "producto":producto,
    "costo":costo,
    "cantidad":cantidad,
    "total":total,
  };
  total_compra=parseFloat(total) + parseFloat(total_compra);

  $("#total").html("");
  $("#total").append(parseFloat(total_compra).toFixed(2));
  console.log(objItems);
  cont++;
}
function eliminarItem(id){
  $("#"+id).remove();
  total_compra=total_compra-objItems[id]["total"];
  $("#total").html("");
  $("#total").append(parseFloat(total_compra).toFixed(2));
  delete objItems[id];
  console.log(objItems);
}

function limpiarCamposVenta(){
  $("#documento").val("");
  $("#provedor").val("");
  $("#num_documento").val("");
  $("#telefono").val("");
  $("#direccion").val("");
  $("#producto").val("");
  $("#costo").val("");
  $("#cantidad").val("");
}

function generarCompra(){
  var tipo_documento=$("#tipo_documento").val();
  var id_cuenta_usuario=$("#id_cuenta").val();
  var documento=$("#documento").val().trim();
  var tipo_pago=$("#tipo_pago").val().trim();
  var provedor=$("#provedor").val().trim();
  var num_documento=$("#num_documento").val().trim();
  var telefono=$("#telefono").val().trim();
  var direccion = $("#direccion").val().trim();

  if(tipo_documento==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione tipo de documento",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(documento==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese número de documento",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(tipo_pago==""){
    swal({
      title:"Alerta!!",
      text:"Seleccione tipo de pago",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(provedor==""){
    swal({
      title:"Alerta!!",
      text:"Ingrese nombre de provedor",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else if(Object.keys(objItems).length === 0){
    swal({
      title:"Alerta!!",
      text:"Ingrese por lo menos un producto a la venta",
      type:"warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok!",
    });
    return;
  }else {
    var parametros={
      "tipo":"Venta",
      "costo_total":parseFloat(total_compra).toFixed(2),
      "tipo_documento":tipo_documento,
      "documento":documento,
      "tipo_pago":tipo_pago,
      "provedor":provedor,
      "num_documento":num_documento,
      "telefono":telefono,
      "direccion":direccion,
      "idcuenta_usuario":id_cuenta_usuario,
      "items":objItems,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/insertar-compra',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){

        console.log("data: "+data);

        if(data){
          swal({
            title:"Guardado!",
            text:"Compra ingresada correctamente.",
            type:"success"
          },
          function(){
            cont=0;
            objItems=new Object();
            total_compra=0;
            limpiarCamposVenta();
            window.location.reload();
            });
        }
      }
    });
  }
}

function verDetalleVenta(id){
//  alert("detalle");
  $("#detalle_venta").modal('show');
  var parametros={
    "idCompras":id,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/obtener-compra',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      limpiarDetalle();
      $("#tipo_documento_detalle").append(data.tipo_documento);
      $("#documento_detalle").append(data.documento);
      $("#provedor_detalle").append(data.proveedor);
      $("#cedula_detalle").append(data.num_documento);
      $("#telefono_detalle").append(data.telefono);
      $("#direccion_detalle").append(data.direccion);
      $("#pago_detalle").append(data.tipo_pago);
      $("#total_ven").append(data.costo_total);
      obtenerItems(id);

    }
  });
}

function obtenerItems(id){
  var parametros={
    "idCompras":id,
    "_token":$('input[name=_token]').val(),
  };
  $.ajax({
    type:'POST',
    url:'/obtener-items-compra',
    async:true,
    cache:false,
    data:parametros,
    dataType:'json',
    success:function(data){
      var html="";
      for (var i = 0; i < data.length; i++) {
        html+="<tr>"
        html+="<td>"+data[i].item+"</td>";
        html+="<td>"+data[i].costo+"</td>";
        html+="<td>"+data[i].cantidad+"</td>";
        html+="<td>"+data[i].total+"</td>";
        html+="</tr>";
      }
      $("#table_detalle").append(html);

    }
  });
}

function limpiarDetalle(){
  $("#tipo_documento_detalle").html("");
  $("#documento_detalle").html("");
  $("#provedor_detalle").html("");
  $("#cedula").html("");
  $("#cedula_detalle").html("");
  $("#telefono_detalle").html("");
  $("#direccion_detalle").html("");
  $("#pago_detalle").html("");
  $("#total_ven").html("");
  $("#table_detalle").html("");
}

function eliminarCompra(id){
  swal({
    title: "Eliminar Compra?",
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
      "idCompras":id,
      "_token":$('input[name=_token]').val(),
    };
    $.ajax({
      type:'POST',
      url:'/borrar-compra',
      async:true,
      cache:false,
      data:parametros,
      dataType:'json',
      success:function(data){

        if(data){
          swal({
            title:"Eliminado!",
            text:"Compra eliminada correctamente.",
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

function cerrarDetalle(){
  $("#detalle_venta").modal('hide');
}

function GenerarPaginadoCompras(){

    $('#tabla_compras').DataTable({
          language: {
                    processing: "Procesando...",
                    search: "Buscar",
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
                          [5, 100, 200, "Todo"]  //opciones del select para la cant de registros a mostrar
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
