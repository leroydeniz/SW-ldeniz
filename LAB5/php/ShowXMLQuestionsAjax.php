 <style>
 .tablapregs {
    border: 2px solid red; 
    text-align:center; 
 }
 .tdpregs {
    padding: 20px; 
    background-color:none; 
        border: 2px solid red; 
    text-align:center; 
 }
 .trpregs {
    padding: 20px; 
    background-color:none; 
        border: 2px solid red; 
    text-align:center; 
 }

  </style> 
 

    <div>
        <?php
            //CABECERA DELA TABLA
            echo "<table class='tablapregs' border=1>";
            echo "<tr><th><b>Autor</b></th><th><b>Enunciado</b></th><th><b>Respuesta</b></th></tr>";
            
            if(!$xml = simplexml_load_file('../xml/Questions.xml')){
                echo "<script>alert('No se ha podido cargar el XML');</script>";
            } else {
                // Accede a los nodos <puntuacion> de la primera pelicula.
                foreach ($xml as $pregunta) {
                    echo "<tr><td class='tdpregs'>".$pregunta['author']."</td><td class='tdpregs'>".$pregunta->itemBody->p."</td><td class='tdpregs'>".$pregunta->correctResponse->response."</td></tr>";
                }
                echo "</table>";
            }
            
        ?>

    </div>