function validate_form() {
    var form = $( "#fquestion" );
    var email = $( "#email" ).val();
    var enunciado = $( "#enunciado" ).val();
    var respuesta_correcta = $( "#respuesta_correcta" ).val();
    var respuesta_mal1 = $( "#respuesta_mal1" ).val();
    var respuesta_mal2 = $( "#respuesta_mal2" ).val();
    var respuesta_mal3 = $( "#respuesta_mal3" ).val();
    var complejidad = $( "#complejidad" ).prop("selectedIndex");
    var tema = $( "#tema" ).val();
    var regex_mail_prof1 = /^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.eus$/;
    var regex_mail_prof2 = /^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.es$/;
    var regex_mail_estd1 = /^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.eus$/;
    var regex_mail_estd2 = /^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.es$/;
    
    if(email.length < 1) {  
        alert("La dirección e-mail es obligatoria");
        return false;
    } else {
        if( email.match(regex_mail_prof1) || email.match(regex_mail_prof2) || email.match(regex_mail_estd1) || email.match(regex_mail_estd2) ) {
            //alert('E-mail institucional correcto.');
        } else {
            alert('No es un e-mail institucional');
            return false;
        }
    }
    if(enunciado.length < 10) {  
        alert("Enunciado demasiado corto");  
        return false;
    }  
    if(respuesta_correcta.length < 1) {  
        alert("Respuesta correcta vacía"); 
        return false;
    }  
    if(respuesta_mal1.length < 1) {  
        alert("Respuesta incorrecta 1 vacía"); 
        return false;
    }  
    if(respuesta_mal2.length < 1) {  
        alert("Respuesta incorrecta 2 vacía");
        return false;
    }  
    if(respuesta_mal3.length < 1) {  
        alert("Respuesta incorrecta 3 vacía");
        return false;
    }    
    if(tema.length < 1) {  
        alert("Tema vacío");
        return false;
    }  
    
    return true;

}