   $(function(){
                  $.validator.addMethod("posicion", function(value, element, param) {
                      //Para el caso que se trate del nombre y el correo
                    var esValido = true;
                    if(value == "")
                    {
                       $('div.persona-a-contactar-'+param+' input').each(function(){
                          if($(this).val() != "" && $(this).attr('type') != 'hidden'){
                              esValido= false;
                          }
                       }); 
                    }
                      
                    return esValido;
               
            }, "Este campo es requerido.");
            
                  $.validator.addMethod("cuadrar", function(value, element, param) {
                      var esValido=true;
                      if(value !=0)
                      {
                          esValido = false;
                      }
                      return esValido;
               
            }, "La sumatoria del valor ingresado en cada forma de pago debe ser igual que el valor de la factura.");
                  
       
       $.validator.addMethod("se-aplica-anualmente", function(value, element, param) {
                      //Para el caso que se trate del nombre y el correo
                    if(value.toUpperCase() == 'SEMESTRE' &&  $(param).is(':checked')){
                        return false;
                    }
                    return true;
            }, "Si el rubro quue se está configurando es semestre no se puede aplicar anualmente. Por favor desmarque esa opción.");
                  $.validator.addMethod("representante", function(value, element, param) {
                      //Para el caso que se trate del nombre y el correo
                    var esValido = true;
                    if(value == "")
                    {
                       $('div.representante input').each(function(){
                          if($(this).val() != "" ){
                              esValido= false;
                          }
                       }); 
                    }
                      
                    return esValido;
               
            }, "Este campo es requerido.");
                  $.validator.addMethod("id-campo", function(value, element, param) {
                      //Para el caso que se trate del nombre y el correo
                    var esValido = true;
                    var indice = $(param).attr('indice');
                    if(value == "")
                    {
                        var hayCamposConDatos = false;
                       $('div.persona-a-contactar-'+indice+' input').each(function(){
                          if( $(this).val() != "" && $(this).attr('type') != 'hidden' ){
                              hayCamposConDatos= true;
                          }
                       }); 
                       if(hayCamposConDatos && $(param).val()=="")
                       {
                           esValido = false;
                       }
                    }
                      
                    return esValido;
               
            }, "Ingrese o el teléfono o el celular.");
            
                  $.validator.addMethod("pareja", function(value, element, param) {
                      if(value=='' && $(param).val()=='') 
                      {
                          return false;
                      }
                      return true;
               
            }, "Ingrese o el teléfono o el celular.");
            
                  $.validator.addMethod("mayusculanumerosespacios", function(value, element, param) {
                if (this.optional(element)) {
                        return true;
                }
                if (typeof param === "string") {
                        param = new RegExp(param);
                }
                return param.test(value);
            }, "Ingrese solo mayúsculas, espacios o números.");
            
                  $.validator.addMethod("mayusculasespacios", function(value, element, param) {
                if (this.optional(element)) {
                        return true;
                }
                if (typeof param === "string") {
                        param = new RegExp(param);
                }
                return param.test(value);
            }, "Ingrese solo mayúsculas o espacios.");
            
                  $.validator.addMethod("mayusculas", function(value, element, param) {
                if (this.optional(element)) {
                        return true;
                }
                if (typeof param === "string") {
                        param = new RegExp(param);
                }
                return param.test(value);
            }, "Ingrese solo letras.");
            
                  $.validator.addMethod("pasaporte", function(value, element, param) {
                if (this.optional(element)) {
                        return true;
                }
                if (typeof param === "string") {
                        param = new RegExp(param);
                }
                return param.test(value);
            }, "Debe comenzar con una letra seguida de 6 dígitos.");
            
                  $.validator.addMethod("cedula", function(value, element, param) {/**
     * Algoritmo para validar cedulas de Ecuador

            * 1.- Se debe validar que tenga 10 numeros
            * 2.- Se extrae los dos primero digitos de la izquierda y compruebo que existan las regiones
            * 3.- Extraigo el ultimo digito de la cedula
            * 4.- Extraigo Todos los pares y los sumo
            * 5.- Extraigo Los impares los multiplico x 2 si el numero resultante es mayor a 9 le restamos 9 al resultante
            * 6.- Extraigo el primer Digito de la suma (sumaPares + sumaImpares)
            * 7.- Conseguimos la decena inmediata del digito extraido del paso 6 (digito + 1) * 10
            * 8.- restamos la decena inmediata - suma / si la suma nos resulta 10, el decimo digito es cero
            * 9.- Paso 9 Comparamos el digito resultante con el ultimo digito de la cedula si son iguales todo OK sino existe error.     
            */
 
  
        
        //Obtenemos el digito de la region que sonlos dos primeros digitos
        var digito_region = value.substring(0,2);
        
        //Pregunto si la region existe ecuador se divide en 24 regiones
        if( digito_region >= 1 && digito_region <=24 ){
          
          // Extraigo el ultimo digito
          var ultimo_digito   = value.substring(9,10);
 
          //Agrupo todos los pares y los sumo
          var pares = parseInt(value.substring(1,2)) + parseInt(value.substring(3,4)) + parseInt(value.substring(5,6)) + parseInt(value.substring(7,8));
 
          //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
          var numero1 = value.substring(0,1);
          var numero1 = (numero1 * 2);
          if( numero1 > 9 ){ var numero1 = (numero1 - 9); }
 
          var numero3 = value.substring(2,3);
          var numero3 = (numero3 * 2);
          if( numero3 > 9 ){ var numero3 = (numero3 - 9); }
 
          var numero5 = value.substring(4,5);
          var numero5 = (numero5 * 2);
          if( numero5 > 9 ){ var numero5 = (numero5 - 9); }
 
          var numero7 = value.substring(6,7);
          var numero7 = (numero7 * 2);
          if( numero7 > 9 ){ var numero7 = (numero7 - 9); }
 
          var numero9 = value.substring(8,9);
          var numero9 = (numero9 * 2);
          if( numero9 > 9 ){ var numero9 = (numero9 - 9); }
 
          var impares = numero1 + numero3 + numero5 + numero7 + numero9;
 
          //Suma total
          var suma_total = (pares + impares);
 
          //extraemos el primero digito
          var primer_digito_suma = String(suma_total).substring(0,1);
 
          //Obtenemos la decena inmediata
          var decena = (parseInt(primer_digito_suma) + 1)  * 10;
 
          //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
          var digito_validador = decena - suma_total;
 
          //Si el digito validador es = a 10 toma el valor de 0
          if(digito_validador == 10)
            var digito_validador = 0;
 
          //Validamos que el digito validador sea igual al de la cedula
          if(digito_validador == ultimo_digito){
           return true;
          }else{
            return false;
          }
          
        }else{
          // imprimimos en consola si la region no pertenece
       return false;
        }
            
    }, "Número de documento inválido.");
    
    
                  $.validator.addMethod("ruc", function(value, element, param) {
       var numero = value;
    /* alert(numero); */

      var suma = 0;      
      var residuo = 0;      
      var pri = false;      
      var pub = false;            
      var nat = false;      
      var numeroProvincias = 22;                  
      var modulo = 11;
                  
      /* Verifico que el campo no contenga letras */                  
      var ok=1;
      for (var i=0; i<numero.length && ok==1 ; i++){
         var n = parseInt(numero.charAt(i));
         if (isNaN(n)) ok=0;
      }
      if (ok==0){
//         alert("No puede ingresar caracteres en el nÃºmero");         
         return false;
      }
                  
      if (numero.length < 10 ){              
//         alert('El nÃºmero ingresado no es vÃ¡lido');                  
         return false;
      }
     
      /* Los primeros dos digitos corresponden al codigo de la provincia */
     var provincia = numero.substr(0,2);      
      if (provincia < 1 || provincia > numeroProvincias){           
//         alert('El cÃ³digo de la provincia (dos primeros dÃ­gitos) es invÃ¡lido');
     return false;       
      }

      /* Aqui almacenamos los digitos de la cedula en variables. */
      var d1  = numero.substr(0,1);         
     var d2  = numero.substr(1,1);         
     var d3  = numero.substr(2,1);         
     var d4  = numero.substr(3,1);         
    var  d5  = numero.substr(4,1);         
    var  d6  = numero.substr(5,1);         
     var d7  = numero.substr(6,1);         
    var  d8  = numero.substr(7,1);         
     var d9  = numero.substr(8,1);         
     var d10 = numero.substr(9,1);                
         
      /* El tercer digito es: */                           
      /* 9 para sociedades privadas y extranjeros   */         
      /* 6 para sociedades publicas */         
      /* menor que 6 (0,1,2,3,4,5) para personas naturales */ 

      if (d3==7 || d3==8){           
//         alert('El tercer dÃ­gito ingresado es invÃ¡lido');                     
         return false;
      }         
         
      /* Solo para personas naturales (modulo 10) */         
      if (d3 < 6){           
         nat = true;            
         var p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
        var  p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
        var p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
        var p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
        var p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
        var p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
        var p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
        var p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
        var p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
         modulo = 10;
      }         

      /* Solo para sociedades publicas (modulo 11) */                  
      /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
      else if(d3 == 6){           
         pub = true;             
         p1 = d1 * 3;
         p2 = d2 * 2;
         p3 = d3 * 7;
         p4 = d4 * 6;
         p5 = d5 * 5;
         p6 = d6 * 4;
         p7 = d7 * 3;
         p8 = d8 * 2;            
         p9 = 0;            
      }         
         
      /* Solo para entidades privadas (modulo 11) */         
      else if(d3 == 9) {           
         pri = true;                                   
         p1 = d1 * 4;
         p2 = d2 * 3;
         p3 = d3 * 2;
         p4 = d4 * 7;
         p5 = d5 * 6;
         p6 = d6 * 5;
         p7 = d7 * 4;
         p8 = d8 * 3;
         p9 = d9 * 2;            
      }
                
      suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
      residuo = suma % modulo;                                         

      /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
      var digitoVerificador = residuo==0 ? 0: modulo - residuo;                

      /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/                         
      if (pub==true){           
         if (digitoVerificador != d9){                          
//            alert('El ruc de la empresa del sector pÃºblico es incorrecto.');            
            return false;
         }                  
         /* El ruc de las empresas del sector publico terminan con 0001*/         
         if ( numero.substr(9,4) != '0001' ){                    
//            alert('El ruc de la empresa del sector pÃºblico debe terminar con 0001');
            return false;
         }
      }         
      else if(pri == true){         
         if (digitoVerificador != d10){                          
//            alert('El ruc de la empresa del sector privado es incorrecto.');
            return false;
         }         
         if ( numero.substr(10,3) != '001' ){                    
//            alert('El ruc de la empresa del sector privado debe terminar con 001');
            return false;
         }
      }      

      else if(nat == true){         
         if (digitoVerificador != d10){                          
//            alert('El nÃºmero de cÃ©dula de la persona natural es incorrecto.');
            return false;
         }         
         if (numero.length >10 && numero.substr(10,3) != '001' ){                    
//            alert('El ruc de la persona natural debe terminar con 001');
            return false;
         }
      }      
      return true;   
            
    }, "Número de RUC inválido.");
            
                  $.validator.setDefaults({
              highlight: function (element) {
                  $(element).closest('.form-group').addClass('has-error');
              },
              unhighlight: function (element) {
                  $(element).closest('.form-group').removeClass('has-error');
              },
              errorElement: 'span',
              errorClass: 'help-block',
              errorPlacement: function (error, element) {
                  if (element.parent('.input-group').length) {
                      error.insertAfter(element.parent());
                  } else {
                      error.insertAfter(element);
                  }
              }
          });
            
            });