$(function() {
  alert("Hola");
});


/*$(function(){  
    
    function validate_form() {
        var email = $( "#email" ).val();
        var enunciado = $( "#enunciado" ).val();
        var respuesta_correcta = $( "#respuesta_correcta" ).val();
        var respuesta_mal1 = $( "#respuesta_mal1" ).val();
        var respuesta_mal2 = $( "#respuesta_mal2" ).val();
        var respuesta_mal3 = $( "#respuesta_mal3" ).val();
        var complejidad = $( "#complejidad" ).prop("selectedIndex");
        var tema = $( "#tema" ).val();
        
        //var regex_mail = /^[a-zA-Z]+(\.?(a-zA-Z)+)?\@$/;
        
        
        //valido email
        if($("#email").val().length < 1) {  
            alert("La dirección e-mail es obligatoria");  
            email.focus();
            return false;
        }  
        if(email.indexOf('@', 0) == -1 || email.val().indexOf('.', 0) == -1) {  
            alert("La dirección es incorrecta");  
            return false;  
        }  
        if($("#enunciado").val().length < 10) {  
            alert("Enunciado demasiado corto");  
            return false;  
        }  
        if($("#respuesta_correcta").val().length < 1) {  
            alert("Respuesta correcta vacía");  
            return false;  
        }  
        if($("#respuesta_mal1").val().length < 1) {  
            alert("Respuesta incorrecta 1 vacía");  
            return false;  
        }  
        if($("#respuesta_mal2").val().length < 1) {  
            alert("Respuesta incorrecta 2 vacía");  
            return false;  
        }  
        if($("#respuesta_mal3").val().length < 1) {  
            alert("Respuesta incorrecta 3 vacía");  
            return false;  
        }  
        
        return true;
        
    }
    
    $( "fquestion" ).submit(vaildate_form);
}); */