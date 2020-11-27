$( document ).ready(function() {
    $('input[name="email"]').focusout( 
    function(){
        
        /* creamos la variable con la solicitud */
        xhr = new XMLHttpRequest();
        
        /* indico qué traer y le paso el parámetro de email para saber si es VIP */
        xhr.open('GET','../php/ClientVerifyEnrollment.php?email='+$("#email").val(), true);
        
        /* le digo qué hacer cuando llegue la respuesta */
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200) {
                $("#validaUsuario").html(xhr.responseText);
            }
        }
        xhr.send('');
        
    });

    $('input[name="password"]').focusout( 
        function(){
            
            /* creamos la variable con la solicitud */
            xhr2 = new XMLHttpRequest();
            
            /* indico qué traer y le paso el parámetro de passsword para validar */
            xhr2.open('GET','../php/ClientVerifyPass.php?password='+$("#password").val()+'&ticket=1010', true);
            
            /* le digo qué hacer cuando llegue la respuesta */
            xhr2.onreadystatechange = function(){
                if(xhr2.readyState == 4 && xhr2.status == 200) {
                    
                    if ( xhr2.responseText == "VALIDA" ){
                        $("#validaPassword").html("<p style='color:green;'>VALIDA.</p>");
				        document.getElementById('submit').disabled = false;
                    } else if( xhr2.responseText == "INVALIDA" ) {
                        $("#validaPassword").html("<p style='color:red;'>INVALIDA.</p>");
				        document.getElementById('submit').disabled = true;
                    } else  if( xhr2.responseText == "SIN SERVICIO" ) {
                        $("#validaPassword").html("<p style='color:blue;'>SIN SERVICIO.</p>");
				        document.getElementById('submit').disabled = true;
                    } else {
                        $("#validaPassword").html(xhr2.responseText);
				        document.getElementById('submit').disabled = true;
                    }
                    
                }
            }
            xhr2.send('');
            
    });
});