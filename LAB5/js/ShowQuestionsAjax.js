function ShowQuestions(){
    if(XMLHttpRequest) {
        xhr = new XMLHttpRequest();
        xhr.open('GET','../php/ShowXMLQuestionsAjax.php', true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('preguntas').innerHTML = xhr.responseText;
            }
        }
        xhr.send('');
    } //cierra if xmlhttprequest
} //cierra la función