$(function(){
var params = {

    onInit: function(data) {
    },
    onCreate: function(notification, data) {
    },
    onClose: function(notification, data) {
    }
    };
   <?php if(isset($mostrarMensajeConfirmacion)) {?>
    var text = 'La operación ha sido realizada con éxito.';
    params.heading = 'Confirmación';
    params.theme = 'lime';
    // show notification
    $.notific8(text, params);
    <?php } ?>
    <?php if(isset($mostrarMensajeErrorValidacion)) {?>
    var text = 'Hay algunos campos de entrada con errores. Por favor rectífiquelos.';
    params.heading = 'Error';
    params.theme = 'ruby';
    // show notification
    $.notific8(text, params);
    <?php } ?>

      function chequearValidacionYEnviarFormulario() {

                var form = $("form[name=login]");
                form.validate();
                if (form.valid() == true)
                {

                    form.submit();
                }

            }
            $("#enviar").click(chequearValidacionYEnviarFormulario);

});


function mostrarLogoMini()
{
          if (getSize()<768)
          {
            document.getElementById("logo_mini").setAttribute("style","display:block");
          }
          else
          {
            document.getElementById("logo_mini").setAttribute("style","display:none");
          }
}

function getSize()
{
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //No-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  return myWidth;
}

window.onload = function alcargar()
{
    //mostrarLogoMini();
};

$("#btn-signup").click(function(){
  alert('holasss');

});

function crearUsuario(){

  alert('holaa');
}
