$(document).ready(function(){
  $("#dashboard").addClass("active");
  GenerarPaginado();
  GenerarPaginadoRealizadas();
});

function GenerarPaginado(){
    $('#tabla_treas').DataTable({
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
function GenerarPaginadoRealizadas(){
    $('#tabla_treas_finalizadas').DataTable({
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
