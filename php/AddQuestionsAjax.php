<?php 
session_start();
//error_reporting(0);
if (isset($_SESSION['user']) && $_SESSION['admin']==0){

	if(isset($_SESSION['user'])){

		$regex_question="/^.{10,}$/";

		$email = $_SESSION['user'];

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

		if(preg_match($regex_question,$_REQUEST['enunciado']) && strlen($enunciado)>10){
							
				if( strlen($respuesta_correcta)>0 && strlen($respuesta_mal1)>0  && strlen($respuesta_mal2)>0  && strlen($respuesta_mal3)>0 && strlen($tema)>0 ) {

									/* MYSQL INICIO */

									//ABRO LA CONEXIÓN
									include 'DbConfig.php';

									$mysqli = mysqli_connect ($server, $user, $pass, $basededatos);

									#Usa la base de datos como utf8
									mysqli_set_charset($mysqli, 'utf8');

									if (!$mysqli) {
										echo "<script>alert('Error en la base de datos: ".mysqli_connect_error()."');document.location.href='HandlingQuizesAjax.php';</script>";
									} else {
										$sql = "INSERT INTO preguntas (email, enunciado, respuesta_correcta, respuesta_mal1, respuesta_mal2, respuesta_mal3, complejidad, tema, imagen_asociada, cuando) VALUES (?,?,?,?,?,?,?,?,?,NOW());";

										//verifico la conexión y la estructura inicial de la sentencia 
										if($stmt = mysqli_prepare($mysqli,$sql)){

											//Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
											mysqli_stmt_bind_param($stmt, "ssssssdss", $email, $enunciado, $respuesta_correcta, $respuesta_mal1, $respuesta_mal2, $respuesta_mal3, $complejidad, $tema, $image);
											mysqli_stmt_execute($stmt);

											mysqli_close($mysqli);

											/* MYSQL FIN */


											/* XML INICIO */

											$xml = simplexml_load_file('../xml/Questions.xml');
											$pregunta = $xml->addChild('assessmentItem');
											$pregunta->addAttribute('subject',$tema);
											$pregunta->addAttribute('author', $email);
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

											echo "Pregunta ingresada correctamente";

										}#cierra proceso de guardado
									} #cierra if !mysqli
				} else {
					echo "Aún quedan campos por completar.";
				}
			} else {
				echo "Enunciado debe tener al menos diez caracteres";
			} #cierra preg_match
	} #cierra if isset
} else {
	echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
}
?>