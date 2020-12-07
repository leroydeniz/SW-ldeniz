setInterval(function() {
        
    var validateEmail = document.getElementById('validaUsuario').innerText;
    var validatePass = document.getElementById('validaPassword').innerText;
    if (validateEmail.length == 13 && validatePass.length == 8) {
        document.getElementById('submit').disabled = false;
    } else {
        document.getElementById('submit').disabled = true;
    }
    
}, 2000);


$( document ).ready(function() {
    
    $('input[name="email"]').focusout(function() {
        
    var validateEmail = document.getElementById('validaUsuario').value;
    var validatePass = document.getElementById('validaPassword').value;
    
    if (validateEmail == '<p style="color:green;">Usuario VIP.</p>' && validatePass == '<p style="color:green;">VALIDA.</p>') {
        document.getElementById('submit').disabled = false;
    } else {
        document.getElementById('submit').disabled = true;
    }
    
} );


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
                    } else if( xhr2.responseText == "INVALIDA" ) {
                        $("#validaPassword").html("<p style='color:red;'>INVALIDA.</p>");
                    } else  if( xhr2.responseText == "SIN SERVICIO" ) {
                        $("#validaPassword").html("<p style='color:blue;'>SIN SERVICIO.</p>");
                    } else {
                        $("#validaPassword").html(xhr2.responseText);
                    }
                    
                }
            }
            xhr2.send('');
            
            
    });
    
});