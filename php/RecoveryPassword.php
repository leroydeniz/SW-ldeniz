<?php 
    session_start();
    if(isset($_SESSION['user'])){
    	echo "<script>alert('No tienes permiso para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>
<!DOCTYPE html>
<html>
    
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include '../php/Menu.php' ?>
  <section class="main" id="s1">
    <div>
        <h2>Recuperar contraseña</h2><br/><br/>
        <form name='fquestion' method='POST' action="" enctype='multipart/form-data'><center>
            <input class="form-control" type="text" name="email" id="email" style="text-align:center;max-width:500px;"  placeholder="Ingresar email" >
            
            </center>
            <br/><br/><input class="btn btn-primary" type="submit"  name="submit" id="submit" value="Recuperar">
            
        </form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  
</body>
</html>

<?php
    
    if(isset($_POST["submit"])) {
        if(isset($_POST["email"])) { 
            $email = $_POST["email"];
        }
        
        include '../php/DbConfig.php';
        require '../lib/class.phpmailer.php';
        
        
        # ABRO LA CONEXIÓN
        $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
        
        #Usa la base de datos como utf8
		mysqli_set_charset($mysqli, 'utf8');
		
        if (!$mysqli) {
			echo "<script>alert('Error en DB: ".mysqli_connect_error()."');</script>";
        } else {
            $sql = "SELECT * FROM usuarios where email=?";
            //verifico la conexión y la estructura inicial de la sentencia 
            if($stmt = mysqli_prepare($mysqli,$sql)){
                # Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
		
                if (mysqli_num_rows($result) == 1) {
                    
                    # creo una nueva contraseña, la guardo cifrada en la base de datos en su respectivo campo y la envío por mail.
                    $datos = mysqli_fetch_array($result);
                    
                    if ($datos['estado']==0) {
                        echo "<script>alert('Usuario bloqueado. Contacte con el administrador.');document.location.href='LogIn.php';</script>";
                    } else {
                        
                        #genero una nueva contraseña
                        $pass_tmp = randomPassword();
                        $pass_tmp_sha1 = sha1($pass_tmp);
                        
                        #echo "<script>alert('Contraseña temporal: ".$pass_tmp." (Eliminar esta línea cuando los mails se envíen correctamente.)');</script>";
                        
                        # la almaceno encriptada en la base de datos
                        $sql2="UPDATE usuarios SET password_tmp = 1, password = ? WHERE email = ? ;";
                        if($stmt = mysqli_prepare($mysqli,$sql2)){
                            mysqli_stmt_bind_param($stmt, "ss", $pass_tmp_sha1, $email);
                            mysqli_stmt_execute($stmt);
                        }
                        mysqli_close($mysqli);
                        
                        
                        
                        # la envío por mail usando la clase mail
                        
                        $Body = "---------------------------------------------------- <br/>";
        				$Body.= "            Recuperación de contraseña               <br/>";
        				$Body.= "---------------------------------------------------- <br/><br/>";
        				$Body.= "Hola ".$datos['nombre_apellido'].",<br/><br/>";
        				$Body.= "Has solicitado recuperar tu contraseña.<br/>";
        				$Body.= "El sistema pedirá que la cambies en el primer ingreso.<br/><br/>";
        				$Body.= "---------------------------------------------------- <br/><br/>";
        				$Body.= "Password temporal: <b>".$pass_tmp."</b><br/><br/>";
        				$Body.= "---------------------------------------------------- <br/><br/>";
        				
        				$headers = "MIME-Version: 1.0" . "\r\n";
				        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				        $headers .= 'From:Quizes Admin <contacto@quizes.com>' . "\r\n";
				        
				        $subject = "Recuperar contraseña | Quizes";
				        
				        //$to = $datos['email'];
        				$to = "leroydeniz@icloud.com";
        								
                        mail($to,$subject,$Body,$headers);
                                                
                        echo "<script>alert('¡Se ha enviado un mail con su contraseña tamporal!');document.location.href='LogIn.php';</script>";
                    }
                } else {
                    echo "<script>alert('No existe ese nombre de usuario.');document.location.href='LogIn.php';</script>"; 
                }
            }
        }
        
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