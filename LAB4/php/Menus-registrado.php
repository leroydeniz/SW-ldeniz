<?php 

$email = $_GET['email'];
echo "<div id='page-wrap'> <header class='main' id='h1'>";

            #Abro la conexión
            include "DbConfig.php";
            $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
            } else {
                
                $sql = "SELECT foto FROM usuarios WHERE email='$email';";
                $resultado = mysqli_query ($mysqli,$sql);
               
               
                #Recupero al foto de ese email
                $row = mysqli_fetch_array( $resultado );
                if($row['foto']!=null) {
                    $foto = "data:image;base64,".$row['foto'];
                } else {
                    $foto = "../images/anonymus.jpg";
                }
               
                #Cierro la conexión
                mysqli_close($mysqli);
            }


    echo "<span class='right'>Usuario: $email</span><span class='right'>&nbsp;&nbsp;<img style='max-width:120px; max-height:60px;' alt='imagen pregunta' src='".$foto."'/></span>
    <span class='right'><br/><br/><a href='LogOut.php?email=$email'>Logout</a></span>
    
    </header>
    
    <nav class='main' id='n1' role='navigation'>
                    <span><a href='Layout.php?email=$email''>Inicio</a></span>
                    <span><a href='QuestionFormWithImage.php?email=$email'> Insertar Pregunta</a></span>
                    <span><a href='ShowXmlQuestions.php?email=$email'> Ver preguntas XML</a></span>
                    <span><a href='ShowQuestionsWithImage.php?email=$email'> Ver preguntas DB</a></span>
                    <span><a href='Credits.php?email=$email''>Creditos</a></span>
    </nav>";
?>