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
  <
  <?php
    if(isset($_GET['email'])){
        include "../php/Menus-registrado.php";
    } else {
        include "../php/Menus.php";
    }
  ?>
  <section class="main" id="s1"><center>
    <div>
        <?php
            //ABRO LA CONEXIÓN
            $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
            } else {
                $sql = "SELECT * FROM preguntas;";
                $resultado = mysqli_query ($mysqli,$sql);
                echo "<h2>Preguntas almacenadas en la base de datos</h2><br/><br/><br/>";
                
                //CABECERA DELA TABLA
                echo "<table border=1>";
                echo "    <tr><th><b>Autor</b></th><th><b>Enunciado</b></th><th><b>Respuesta</b></th><th><b>Imagen</b></th></tr>";
                
                while( $row = mysqli_fetch_array( $resultado)){
                    if ($row['imagen_asociada']!=NULL){
                        echo "    <tr><td>".$row['email']."</td><td>".$row['enunciado']."</td><td>".$row['respuesta_correcta']."</td><td><img style='max-width:120px; max-height:120px;' alt='imagen pregunta' src='data:image;base64,".$row['imagen_asociada']."'/></td></tr>";
                    } else {
                        echo "    <tr><td>".$row['email']."</td><td>".$row['enunciado']."</td><td>".$row['respuesta_correcta']."</td><td></td></tr>";
                    }
                    
                }
                
                echo "</table>";
                
                // CIERRO LA CONEXIÓN
                mysqli_close($mysqli);
            }
        ?>

    </div><br/><br/><br/><br/><br/>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
