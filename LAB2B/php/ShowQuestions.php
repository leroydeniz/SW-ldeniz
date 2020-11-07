<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <?php include '../php/DbConfig.php'?>
  <style>
      table, th, td { 
                border: 2px solid red; 
                text-align:center; 
            } 
            th, td { 
                padding: 20px; 
                background-color:none; 
            } 
  </style> 
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1"><center>
    <div>
        <?php
            //ABRO LA CONEXIÓN
            $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
            } else {
                $sql = "SELECT * FROM preguntas WHERE imagen_asociada IS NULL;";
                $resultado = mysqli_query ($mysqli,$sql);
                echo "<h2>Preguntas sin imagen almacenadas en la base de datos</h2><br/><br/><br/>";
                
                //CABECERA DELA TABLA
                echo "<table border=1>";
                echo "    <tr><th><b>Autor</b></th><th><b>Enunciado</b></th><th><b>Respuesta</b></th></tr>";
                
                while( $row = mysqli_fetch_array( $resultado)){
                    echo "    <tr><td>".$row['email']."</td><td>".$row['enunciado']."</td><td>".$row['respuesta_correcta']."</td></tr>";
                }
                
                echo "</table>";
                
                // CIERRO LA CONEXIÓN
                mysqli_close($mysqli);
            }
        ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
