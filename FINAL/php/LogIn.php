<?php 
    session_start();
    if(isset($_SESSION['user'])){
    	echo "<script language=\"javascript\">alert(\"Usuario ya logueado.\");document.location.href='Layout.php';</script>";
    }
?>
<!DOCTYPE html>
<html>
    
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
</head>
<body>
  <?php include '../php/Menu.php' ?>
  <section class="main" id="s1">
    <div>
        <h2>Identificación de usuarios</h2><br/><br/>
        <form name='fquestion' method='POST' action="" enctype='multipart/form-data'><center>
            <table>
                <tr>
                    <td>
                        Email (*):
                    </td>
                    <td>
                        <input type="text" name="email" id="email" size="60" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Password (*):
                    </td>
                    <td>
                        <input type="password" name="password" id="password" size="60" >
                    </td>
                </tr>
            </table>
            
            <label id="mensaje"></label>
            
            </center>
            <br/><br/><input type="submit" name="submit" id="submit" value="Enviar solicitud">
            
            <br/><br/><a href="RecoveryPassword.php">¿Has olvidado la contraseña?</a>
            
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
        if(isset($_POST["password"])) { 
            $password = $_POST["password"];
        }
        
        include '../php/DbConfig.php';
        #Usa la base de datos como utf8
		mysqli_set_charset($mysqli, 'utf8');
        
        # ABRO LA CONEXIÓN
        $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
        } else {
            $sql = "SELECT * FROM usuarios where email=? AND password=?;";
            //verifico la conexión y la estructura inicial de la sentencia 
            if($stmt = mysqli_prepare($mysqli,$sql)){
                # Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
                mysqli_stmt_bind_param($stmt, "ss", $email, sha1($password));
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
		
                if (mysqli_num_rows($result) == 1) {
                    
                    #tomo los datos de la última conexión y lo guardo en una variable global antes de actualizarlos
                    $datos = mysqli_fetch_array($result);
                    
                    if ($datos['estado']==0) {
                        echo "<script>alert('Usuario bloqueado. Contacte con el administrador.');document.location.href='LogIn.php';</script>";
                    } else {
                        
                        #como el usuario existe, inicio la sesión
    			        session_start();
    			        
            			$_SESSION['user'] = $email;
            			$_SESSION['nombre_apellido'] = $datos['nombre_apellido'];
            			$_SESSION['ultimo_acceso'] = $datos['ultimo_acceso'];
            			$_SESSION['tipo_usuario'] = $datos['tipo_usuario'];
            			$_SESSION['foto'] = $datos['foto'];
            			$_SESSION['admin']= $datos['admin'];
            			$_SESSION['password_tmp']= $datos['password_tmp'];
            			
            			#actualizo la última conexión
                        $sql2="UPDATE usuarios SET ultimo_acceso = NOW() WHERE email = ? ;";
                        if($stmt = mysqli_prepare($mysqli,$sql2)){
                            mysqli_stmt_bind_param($stmt, "s", $email);
                            mysqli_stmt_execute($stmt);
                        }
                        
                        mysqli_close($mysqli);
                        
                        #actualizo el ´numero de usuarios online
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
                        
                        if ($datos['password_tmp']==1) {
                            #primer intento de acceso luego de reiniciar la contrasñea
                            echo "<script>alert('¡Hola ".$_SESSION['nombre_apellido'].", primero deberías actualizar tu contraseña!');document.location.href='UpdatePass.php';</script>";
                        } else {
                            echo "<script>alert('¡Bienvenido ".$_SESSION['nombre_apellido']."!');document.location.href='Layout.php';</script>";
                        }
                    }
                } else {
                    echo "<script>alert('Usuario o contraseña incorrectos');document.location.href='LogIn.php';</script>"; 
                }
            }
        }
        
    }
    
?>








