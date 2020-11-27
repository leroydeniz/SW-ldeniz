<?php 
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['admin']==0){
    
        if(!$xml = simplexml_load_file('../xml/Questions.xml')){
            echo "<script>alert('No se ha podido cargar el XML');</script>";
        } else {
            $counterTotal=0;
            $counterPropias=0;
            
            foreach ($xml as $pregunta) {
                $counterTotal = $counterTotal +1;
                # necesito el mail para poder saber, de todas las preguntas, cuáles son del usuario que consulta
                if($pregunta['author'] == $_SESSION['user']){
                    $counterPropias = $counterPropias +1;
                }
            }
            echo "Todas las preguntas: ".$counterTotal." | Mis preguntas: ".$counterPropias;
        }
    
    } else {
        echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>