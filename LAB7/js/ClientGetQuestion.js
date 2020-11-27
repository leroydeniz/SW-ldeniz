function BuscarDatosPregunta(){
    var pId = document.getElementById('idpregunta').value;
    if(XMLHttpRequest) {
        xhr = new XMLHttpRequest();
        xhr.open('GET','../php/ClientGetQuestionWS.php?pId='+pId, true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('div-info').innerHTML = xhr.responseText;
            }
        }
        xhr.send('');
    } //cierra if xmlhttprequest
} //cierra la función