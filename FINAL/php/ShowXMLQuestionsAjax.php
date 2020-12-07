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
            //ABRO LA CONEXIÓN
            include '../php/DbConfig.php';
            $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
            } else {
                
                $sql = "SELECT * FROM preguntas;";
                $resultado = mysqli_query ($mysqli,$sql);
                
                //CABECERA DELA TABLA
                echo "<table border=1 class='tablapregs'>";
                echo "    <tr class='trpregs'><th class='tdpregs'><b>Autor</b></th><th class='tdpregs'><b>Enunciado</b></th><th class='tdpregs'><b>Respuesta</b></th><th class='tdpregs' class='tdpregs'><b>Imagen</b></th></tr>";
                
                while( $row = mysqli_fetch_array( $resultado )){
                    if ($row['imagen_asociada']!=NULL){
                        echo "    <tr class='trpregs'><td class='tdpregs'>".$row['email']."</td><td class='tdpregs'>".$row['enunciado']."</td><td class='tdpregs'>".$row['respuesta_correcta']."</td><td class='tdpregs'><img style='max-width:120px; max-height:120px;' alt='imagen pregunta' src='data:image;base64,".$row['imagen_asociada']."'/></td></tr>";
                    } else {
                        echo "    <tr class='trpregs'><td class='tdpregs'>".$row['email']."</td><td class='tdpregs'>".$row['enunciado']."</td><td class='tdpregs'>".$row['respuesta_correcta']."</td><td class='tdpregs'></td></tr>";
                    }
                    
                }
                
                echo "</table>";
                
                // CIERRO LA CONEXIÓN
                mysqli_close($mysqli);
            }
            
        ?>

    </div>