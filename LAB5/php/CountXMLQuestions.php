<?php
    $email = $_GET['email'];
    
    if(!$xml = simplexml_load_file('../xml/Questions.xml')){
        echo "<script>alert('No se ha podido cargar el XML');</script>";
    } else {
        $counterTotal=0;
        $counterPropias=0;
        
        foreach ($xml as $pregunta) {
            $counterTotal = $counterTotal +1;
            if($pregunta['author']==$email){
                $counterPropias = $counterPropias +1;
            }
        }
        echo "Todas las preguntas: ".$counterTotal." | Mis preguntas: ".$counterPropias;
    }
    
?>