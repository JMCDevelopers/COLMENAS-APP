$(document).ready(function(){
  $("#dashboard").addClass("active");
  cargarCalendario();

});


function cargarCalendario(){

var hoy = new Date();
  initThemeChooser({

      init: function(themeSystem) {
        $('#calendar').fullCalendar({
          lang: 'es',
          themeSystem: themeSystem,
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
          },
          defaultDate: hoy,
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          events: '/tareas'

        });
      },



    });
}

// editar tarea
function editarTarea(id){
  var url="editar-tarea/"+id;
  window.location.href=url;
}

function recordinarTarea(id){
  var start=$("#start").val();
  var parametros={
      "_token":$('input[name=_token]').val(),
      "id":id,
      "start":start,
    };
    $.ajax({
      type:'POST',
      url:'/recordinar-tarea',
      async:true,
      cache:false,
      data: parametros,
      dataType:'json',
      success:function(data){
        if(data){
          swal({
            title:"Recordinado!",
            text:"Tarea recordinada correctamente!",
            type:"success"
          },
          function(){
              window.location.href='../gestion-tareas';
            });
        }

      }
  });
}
function finalizarTarea(id){

  var parametros={
      "_token":$('input[name=_token]').val(),
      "id":id,
    };
    $.ajax({
      type:'POST',
      url:'/finalizar-tarea',
      async:true,
      cache:false,
      data: parametros,
      dataType:'json',
      success:function(data){
        if(data){
          swal({
            title:"Finalizado!",
            text:"Tarea Finalizada correctamente!",
            type:"success"
          },
          function(){
              window.location.href='../gestion-tareas';
            });
        }else{
          swal('No finalizo');
        }

      }
  });
}

function eliminarTarea(id){
  swal({
    title: "Eliminar Tarea?",
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
        "_token":$('input[name=_token]').val(),
        "id":id,
      };
      $.ajax({
        type:'POST',
        url:'/eliminar-tarea',
        async:true,
        cache:false,
        data: parametros,
        dataType:'json',
        success:function(data){
          if(data){
            swal({
              title:"Eliminado!",
              text:"Tarea eliminada correctamente!",
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

function CrearTarea(){
  var form=$("#frm_crear_tarea");
  $.ajax({
    type:'GET',
    url:'/guardar-tarea',
    async:true,
    cache:false,
    data: form.serialize(),
    dataType:'json',
    success:function(data){
      if(data){
        swal({
          title:"Guardado!",
          text:"Tarea guardada correctamente!",
          type:"success"
        },
        function(){
            window.location.reload();
          });
      }
    }
});
}
