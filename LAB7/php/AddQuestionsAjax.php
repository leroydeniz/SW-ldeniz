
 <?php
    error_reporting(0);
    if(isset($_REQUEST['email'])){
        
        $regex_mail_prof1 = "/^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.eus$/";
        $regex_mail_prof2 = "/^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.es$/";
        $regex_mail_estd1 = "/^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.eus$/";
        $regex_mail_estd2 = "/^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.es$/";
        $regex_question="/^.{10,}$/";
		
		
        if(isset($_REQUEST['email'])){
            $email = $_REQUEST['email'];
        }
        if(isset($_REQUEST['emailform'])){
            $emailform = $_REQUEST['emailform'];
        }
        if(isset($_REQUEST['enunciado'])){
            $enunciado = $_REQUEST['enunciado'];
        }
        if(isset($_REQUEST['respuesta_correcta'])){
            $respuesta_correcta = $_REQUEST['respuesta_correcta'];
        }
        if(isset($_REQUEST['respuesta_mal1'])){
            $respuesta_mal1 = $_REQUEST['respuesta_mal1'];
        }
        if(isset($_REQUEST['respuesta_mal2'])){
            $respuesta_mal2 = $_REQUEST['respuesta_mal2'];
        }
        if(isset($_REQUEST['respuesta_mal3'])){
            $respuesta_mal3 = $_REQUEST['respuesta_mal3'];
        }
        if(isset($_REQUEST['complejidad'])){
            $complejidad = $_REQUEST['complejidad'];
        }
        if(isset($_REQUEST['tema'])){
            $tema = $_REQUEST['tema'];
        }

        if($_FILES==null || $_REQUEST==null){
            $image = null;
        } else {
            $file = $_FILES["imgInp"]["tmp_name"];
            if(isset($file)){
                $imgInp = file_get_contents(addslashes($_FILES['imgInp']['tmp_name']));
                $image = base64_encode($imgInp);
            }
        }

		
		
         
         if(preg_match($regex_question,$_REQUEST['enunciado']) && (preg_match($regex_mail_prof1,$_REQUEST['emailform']) || preg_match($regex_mail_prof2,$_REQUEST['emailform']) || preg_match($regex_mail_estd1,$_REQUEST['emailform']) || preg_match($regex_mail_estd1,$_REQUEST['emailform']))){
                
            /* MYSQL INICIO */
                                
           //ABRO LA CONEXIÓN
           include 'DbConfig.php';
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
                    
                        
                }#cierra proceso de guardado
            } #cierra if !mysqli
        } #cierra preg_match
    } #cierra if isset
?>