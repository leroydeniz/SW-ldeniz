setInterval(function() {
        
        /* creamos la variable con la solicitud */
        xhr = new XMLHttpRequest();
        
        /* indico qué traer y le paso el parámetro de email para saber las preguntas del usuaropio */
        xhr.open('GET','../php/CountXMLQuestions.php?email='+$("#email").val(), true);
        
        /* le digo qué hacer cuando llegue la respuesta */
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200) {
                $("#qcounter").html(xhr.responseText);
                //document.getElementById('qcounter').innerHTML = xhr.responseText;
            }
        }
        xhr.send('');
}, 10000);