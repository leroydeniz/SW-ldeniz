<?php header("refresh:5,url=ShowQuestionsWithImage.php"); 
error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <?php include '../php/DbConfig.php'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

        <?php
        
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['enunciado'])){
            $enunciado = $_POST['enunciado'];
        }
        if(isset($_POST['respuesta_correcta'])){
            $respuesta_correcta = $_POST['respuesta_correcta'];
        }
        if(isset($_POST['respuesta_mal1'])){
            $respuesta_mal1 = $_POST['respuesta_mal1'];
        }
        if(isset($_POST['respuesta_mal2'])){
            $respuesta_mal2 = $_POST['respuesta_mal2'];
        }
        if(isset($_POST['respuesta_mal3'])){
            $respuesta_mal3 = $_POST['respuesta_mal3'];
        }
        if(isset($_POST['complejidad'])){
            $complejidad = $_POST['complejidad'];
        }
        if(isset($_POST['tema'])){
            $tema = $_POST['tema'];
        }
        
        if($_FILES!=null && $_POST!=null){
            $file = $_FILES["imgInp"]["tmp_name"];   
        
            if(!isset($file)){
                echo "Please upload an image";
            }else{
                $imgInp = file_get_contents(addslashes($_FILES['imgInp']['tmp_name']));
        
                $image_size = getimagesize($_FILES['imgInp']['tmp_name']);
        
                if($image_size==FALSE){
                    echo "No se ha seleccionado una imagen.";
                } else {
                   $image = base64_encode($imgInp);
                }
            }
        }
        
        
        
        //ABRO LA CONEXIÓN
        $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><h3>Será redirigido al banco de preguntas en 5 segundos</h3><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
        } else {
            $sql = "INSERT INTO preguntas (email, enunciado, respuesta_correcta, respuesta_mal1, respuesta_mal2, respuesta_mal3, complejidad, tema, imagen_asociada, cuando) VALUES (?,?,?,?,?,?,?,?,?,NOW());";
            
            //verifico la conexión y la estructura inicial de la sentencia 
            if($stmt = mysqli_prepare($mysqli,$sql)){
                
                //Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
                mysqli_stmt_bind_param($stmt, "ssssssdss", $email, $enunciado, $respuesta_correcta, $respuesta_mal1, $respuesta_mal2, $respuesta_mal3, $complejidad, $tema, $image);
                mysqli_stmt_execute($stmt);
                
                
            /*$sql = "INSERT INTO preguntas (email, enunciado, respuesta_correcta, respuesta_mal1, respuesta_mal2, respuesta_mal3, complejidad, tema, imagen_asociada, cuando) VALUES ('".$email."', '".$enunciado."', '".$respuesta_correcta."', '".$respuesta_mal1."', '".$respuesta_mal2."', '".$respuesta_mal3."', ".$complejidad.", '".$tema."', '".$image."', NOW()); ";
            mysqli_query ($mysqli,$sql);*/
            //echo $sql;
            // CIERRO LA CONEXIÓN
            mysqli_close($mysqli);
        }
        
        
        echo "<center><br/><br/><h2> Pregunta con imagen correctamente guardada en la base de datos!</h2><br/><br/><br/><h3>Será redirigido al banco de preguntas en 5 segundos</h3><br/><br/><img src='../images/ok.png' style='max-width:200px;'></center>";
        }
     ?>    	

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>