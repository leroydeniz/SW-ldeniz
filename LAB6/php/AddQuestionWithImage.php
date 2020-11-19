<?php
    error_reporting(0);
?>
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
                    if(isset($_POST['emailform'])){
                        $emailform = $_POST['emailform'];
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
                    } else {
                        $image = null;
                    }

                    $regex_mail_prof1 = "/^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.eus$/";
                    $regex_mail_prof2 = "/^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.es$/";
                    $regex_mail_estd1 = "/^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.eus$/";
                    $regex_mail_estd2 = "/^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.es$/";

                    if(strlen($email) < 1) {
                        echo "<script>alert(\"La dirección e-mail es obligatoria\");document.location.href='QuestionFormWithImage.php?email=$email';</script>"; 
                    } else {
                        if(preg_match($regex_mail_prof1, $emailform) || preg_match($regex_mail_prof2, $emailform) || preg_match($regex_mail_estd1, $emailform) || preg_match($regex_mail_estd2, $emailform)){
                        #Email correcto, inicio*****
                        
                            if(strlen($enunciado) < 10) {
                                echo "<script language=\"javascript\">alert(\"Enunciado vacío o menor a 10 caracteres\");document.location.href='QuestionFormWithImage.php?email=$email';</script>"; 
                            } else {
                            #Enunciado correcto, inicio*****
                                if(strlen($respuesta_correcta) < 1 || strlen($respuesta_mal1) < 1 || strlen($respuesta_mal2) < 1 || strlen($respuesta_mal3) < 1) {
                                    echo "<script language=\"javascript\">alert(\"Alguna de las respuestas está vacía\");document.location.href='QuestionFormWithImage.php?email=$email';</script>"; 
                                } else {
                                #Respuestas correctas, inicio*****
                                    if(strlen($tema) < 1) {
                                        echo "<script language=\"javascript\">alert(\"Tema de la pregunta no puede estar vacío\");document.location.href='QuestionFormWithImage.php?email=$email';</script>"; 
                                    } else {
                                    #Tema correcto, inicio*****
                        
                                        /* MYSQL INICIO */
                                        
                                       //ABRO LA CONEXIÓN
                                        $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
                                        if (!$mysqli) {
                                            die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><h3>Será redirigido al banco de preguntas en 5 segundos</h3><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
                                        } else {
                                            $sql = "INSERT INTO preguntas (email, enunciado, respuesta_correcta, respuesta_mal1, respuesta_mal2, respuesta_mal3, complejidad, tema, imagen_asociada, cuando) VALUES (?,?,?,?,?,?,?,?,?,NOW());";
                                    
                                            //verifico la conexión y la estructura inicial de la sentencia 
                                            if($stmt = mysqli_prepare($mysqli,$sql)){
                                        
                                                //Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
                                                mysqli_stmt_bind_param($stmt, "ssssssdss", $emailform, $enunciado, $respuesta_correcta, $respuesta_mal1, $respuesta_mal2, $respuesta_mal3, $complejidad, $tema, $image);
                                                mysqli_stmt_execute($stmt);
                                        
                                                mysqli_close($mysqli);
                                                
                                                /* MYSQL FIN */
                                                
                                                
                                                /* XML INICIO */
                                                
                                                $xml = simplexml_load_file('../xml/Questions.xml');
                                                $pregunta = $xml->addChild('assessmentItem');
                                                $pregunta->addAttribute('subject',$tema);
                                                $pregunta->addAttribute('author', $emailform);
                                                $enun = $pregunta->addChild('itemBody');
                                                $enun->addChild('p', $enunciado);
                                                $resp_corre=$pregunta->addChild('correctResponse');
                                                $resp_corre->addChild('response', $respuesta_correcta);
                                                $resp_incorre=$pregunta->addChild('incorrectResponses');
                                                $resp_incorre->addChild('response',$respuesta_mal1);
                                                $resp_incorre->addChild('response',$respuesta_mal2);
                                                $resp_incorre->addChild('response',$respuesta_mal3);
                                            
                                                //echo $xml->asXML(); 
                                                $xml->asXML('../xml/Questions.xml');
                                                
                                                /* XML FIN */
                                                
                                                echo "<script>alert('Pregunta guardada correctamente! ');document.location.href='ShowQuestionsWithImage.php?email=$email';</script>"; 
                                            }
                                        }
                                
                            
                                    #Tema correcto, fin*****
                                    }
                                #Respuestas correctas, fin*****
                                }
                            #Enunciado correcto, fin*****    
                            }
                        #Email correcto, fin*****    
                        } else {
                            echo "<script>alert(\"No es un email institucional\");document.location.href='QuestionFormWithImage.php?email=$email';</script>"; 
                        }
                    }
                ?>    	

            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>