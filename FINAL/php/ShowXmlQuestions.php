<?php 
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['tipo_usuario']=="alumno" && $_SESSION['admin']==0){
?>
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
  <?php
    include "../php/Menu.php";
  ?>
  <section class="main" id="s1"><center>
    <div>
        <?php
            
                //CABECERA DELA TABLA
                echo "<table border=1>";
                echo "<tr><th><b>Autor</b></th><th><b>Enunciado</b></th><th><b>Respuesta</b></th></tr>";
                
                if(!$xml = simplexml_load_file('../xml/Questions.xml')){
                    echo "<script>alert('No se ha podido cargar el XML');</script>";
                } else {
                    // Accede a los nodos <puntuacion> de la primera pelicula.
                    foreach ($xml as $pregunta) {
                        echo "<tr><td>".$pregunta['author']."</td><td>".$pregunta->itemBody->p."</td><td>".$pregunta->correctResponse->response."</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
                }
            
        ?>

    </div><br/><br/><br/><br/><br/><br/><br/>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>

<?php
    } else {
        echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>