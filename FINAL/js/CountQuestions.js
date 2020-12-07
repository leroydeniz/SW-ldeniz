setInterval(function() {
        
        /* creamos la variable con la solicitud */
        xhr = new XMLHttpRequest();
        
        /* indico qué traer y le paso el parámetro de email para saber las preguntas del usuario */
        xhr.open('GET','../php/CountXMLQuestions.php', true);
        
        /* le digo qué hacer cuando llegue la respuesta */
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200) {
                $("#qcounter").html(xhr.responseText);
                //document.getElementById('qcounter').innerHTML = xhr.responseText;
            }
        }
        xhr.send('');
        
        /* creamos la variable con la solicitud */
        xhr2 = new XMLHttpRequest();
        
        /* indico qué traer y le paso el parámetro de email para saber las preguntas del usuario */
        xhr2.open('GET','../php/CountXMLUsers.php', true);
        
        /* le digo qué hacer cuando llegue la respuesta */
        xhr2.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr2.status == 200) {
                //$("#ucounter").html(xhr2.responseText);
                document.getElementById('ucounter').innerHTML = xhr2.responseText;
            }
        }
        xhr2.send('');
}, 2000);

