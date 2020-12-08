<?php 
    session_start();
    if(isset($_SESSION['user'])){
    	echo "<script>alert('Usuario ya logueado.');document.location.href='Layout.php';</script>";
    }
?>
<html>	
<head>
  <?php include '../html/Head.html'; ?>
</head>
<body>
  <?php include 'Menu.php' ?>
  <section class="main" id="s1">

    <?php 
		require ("../vendor/autoload.php");
		require ("DbConfig.php");
		# Conseguir el código de autorización
		$code = isset($_GET['code']) ? $_GET['code'] : NULL;
	
		# Conseguir token de acceso
		if(isset($code)) {
			try {
				$token = $cliente->fetchAccessTokenWithAuthCode($code);
				$cliente->setAccessToken($token);
			}catch (Exception $e){
				echo $e->getMessage();
			}
			
			try {
				$pay_load = $cliente->verifyIdToken();

			}catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}else{
			$pay_load = null;
		}
	
		if(isset($code)) {
			$google_service = new Google_Service_Oauth2($cliente);
			$data = $google_service->userinfo->get();
		}
	
		if(isset($pay_load)){
			session_start();
			$_SESSION['nombre_apellido'] = $data["name"];
			$_SESSION["foto_google"] = $data["picture"];
			$_SESSION['user'] = $pay_load["email"];
			$_SESSION['byGoogle'] = 1;
			$_SESSION['ultimo_acceso'] = date("Y-m-d H:i:s");
			
			#actualizo el numero de usuarios online
			if(!$xml = simplexml_load_file('../xml/UserCounter.xml')){
				echo "<script>alert('No se ha podido cargar el XML en IncreaseGlobalCounter.php');</script>";
			} else {
				# toma el primer y único elemento del xml que lleva el control del total de usuarios y le incrementa uno
				$suma = $xml->totalOfUsers;
				$suma = $suma + 1;
				$xml->totalOfUsers = $suma;
				# guardo el nuevo xml
				$xml->asXML('../xml/UserCounter.xml');
			}
			
			
			# lo registro la primera vez que acceda al al  
			$mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
			if (!$mysqli) {
				die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
			} else {

				$sql = "SELECT email FROM usuarios WHERE email=?";
				if($stmt = mysqli_prepare($mysqli,$sql)){
					mysqli_stmt_bind_param($stmt, "s", $email);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					$existe = mysqli_num_rows($result);
					
					# si no esta registrado en la base de datos, se guarda
					if($existe==0) {
						
						$email = $_SESSION['user'];
						$nombre_apellido = $_SESSION['nombre_apellido'];
						
						#genero una nueva contraseña
						$pass_tmp = randomPassword();
						$pass_tmp = sha1($pass_tmp);
						
						# INSERTO EL USUARIO
						$sql = "INSERT INTO usuarios (email, tipo_usuario, nombre_apellido, password, cuando, ultimo_acceso) VALUES (?,'alumno',?,?,NOW(),NOW());";
						//verifico la conexión y la estructura inicial de la sentencia
						if($stmt = mysqli_prepare($mysqli,$sql)){

							//Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
							mysqli_stmt_bind_param($stmt, "sss", $email,  $nombre_apellido, $pass_tmp);
							mysqli_stmt_execute($stmt);

							mysqli_close($mysqli);
						}//cierra registro en db

					} //cierra usuario existente
				}

			} //cierra conexión
			
			echo "<script> alert('¡Bienvenido ".$_SESSION['nombre_apellido']."!'); document.location.href='Layout.php'; </script>";
		}

		function randomPassword() {
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$pass = array();
			$alphaLength = strlen($alphabet) - 1;
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			return implode($pass);
		}
	
		?>
	
      
      </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>