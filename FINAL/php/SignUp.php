<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
			
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	
    	<script src="../js/jquery-3.4.1.min.js"></script>
    	<script src="../js/ShowImageInForm.js"></script>
   	 	<script src="../js/ValidateWS.js"></script>
   	 	<script src="../js/validarBoton.js"></script>
	
</head>
<body>

  <?php
    include "../php/Menu.php";
  ?>

  <?php include '../php/DbConfig.php'?>
  <section class="main" id="s1">
    <div>
        <h2>Registro de usuarios</h2><br/><br/>
        <form name='fquestion' method='POST' action="" enctype='multipart/form-data'><center>
            <table>
                <tr>
                    <td>
                        Tipo de usuario: &nbsp;&nbsp;
                        <input type="radio" id="alumno" name="tipo" value="alumno">
                        <label for="alumno">Alumno</label> 
                        <input type="radio" id="profesor" name="tipo" value="profesor">
                        <label for="profesor">Profesor</label><br/><br/>
                    </td>
                    <td rowspan="9">
                        <img id="output" src="" style="max-width:200px;margin-left:20px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="email" id="email" size="60"  class="form-control"  placeholder="Email" style="text-align: center" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 id="validaUsuario" style="text-align: center;vertical-align: middle;">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nombre_apellidos" id="nombre_apellidos" size="60"  class="form-control" placeholder="Nombre y apellido" style="text-align: center" required/><br/><br/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="password" id="password" size="60" class="form-control"  placeholder="Password" style="text-align: center" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 id="validaPassword"style="text-align: center;vertical-align: middle;" >
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="re_password" id="re_password" size="60" class="form-control"  placeholder="Repetir Password" style="text-align: center" required/><br/><br/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Foto de perfil: <input type="file" class="form-control" name="imgInp" id="imgInp" size="30" accept="image/*"  onchange="loadFile(event)" />
                    </td>
                </tr>
            </table>
            
            <label id="mensaje"></label>
            
            </center>
            <br/><br/><input type="submit" class="btn btn-primary" name="submit" id="submit" value="Enviar solicitud" disabled/>
        </form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  
</body>
</html>



<?php

    


    if(isset($_POST["submit"])) {
        
        $regex_mail_prof1 = "/^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.eus$/";
        $regex_mail_prof2 = "/^[a-zA-Z]+(\.?[a-zA-Z]+)?\@ehu\.es$/";
        $regex_mail_estd1 = "/^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.eus$/";
        $regex_mail_estd2 = "/^[a-zA-Z]+[0-9]{3}\@ikasle\.ehu\.es$/"; 
    
    
        if(isset($_POST["tipo"])) { 
            $tipo = $_POST["tipo"];
        } else {
            $tipo = "";
        }
        if(isset($_POST["nombre_apellidos"])) { 
            $nombre_apellidos = $_POST["nombre_apellidos"];
        } else {
            $nombre_apellidos = "";
        }
        if(isset($_POST["email"])) { 
            $email = $_POST["email"];
        } else {
            $email = "";
        }
        if(isset($_POST["password"])) { 
            $password = $_POST["password"];
        } else {
            $password = "";
        }
        if(isset($_POST["re_password"])) { 
            $re_password = $_POST["re_password"];
        } else {
            $re_password = "";
        }
        if($_FILES!=null && $_POST!=null){
            $file = $_FILES["imgInp"]["tmp_name"];   
        
            if(!isset($file)){
                echo "Please upload an image";
            }else{
                $imgInp = file_get_contents(addslashes($_FILES['imgInp']['tmp_name']));
                $image_size = getimagesize($_FILES['imgInp']['tmp_name']);
        
                if($image_size==FALSE){
                    $image = "";
                } else {
                   $image = base64_encode($imgInp);
                }
            }
        } else {
            $image = "";
        }
        
        if(strlen($password)<6) {
            echo "<script>alert('La contraseña debe tener al menos seis dígitos')</script>";
        } else {
            #Contraseña OK
            if($password != $re_password) {
                echo "<script>alert('Las contraseñas no coinciden')</script>";
            } else {
                #Contraseñas iguales OK
                if (empty($tipo) || empty($nombre_apellidos) || empty($email)) {
                    echo "<script>alert('Hay campos obligatorios vacios')</script>";
                } else {
                    if(!(preg_match($regex_mail_prof1, $email) || preg_match($regex_mail_prof2, $email) || preg_match($regex_mail_estd1, $email) || preg_match($regex_mail_estd2, $email))){ 
                        echo "<script>alert('Email no institucional')</script>";
                    } else {
                        if (((preg_match($regex_mail_prof1, $email) || preg_match($regex_mail_prof2, $email)) && $tipo=='profesor') || ((preg_match($regex_mail_estd1, $email) || preg_match($regex_mail_estd2, $email)) && $tipo=='alumno') ) {
                            //ABRO LA CONEXIÓN
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
                                    if($existe!=0) {
                                        echo "<script>alert(\"¡Usuario ya existe!\");</script>";
                                    } else {
                                    
                                        //INSERTO EL USUARIO
                                        $sql = "INSERT INTO usuarios (email, tipo_usuario, nombre_apellido, password, foto, cuando,ultimo_acceso) VALUES (?,?,?,?,?,NOW(),NOW());";
                                        //verifico la conexión y la estructura inicial de la sentencia 
                                        if($stmt = mysqli_prepare($mysqli,$sql)){
                                            
                                            //Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
                                            mysqli_stmt_bind_param($stmt, "sssss", $email, $tipo, $nombre_apellidos, sha1($password), $image);
                                            mysqli_stmt_execute($stmt);
                                            
                                            mysqli_close($mysqli);
                                            echo "<script>alert('¡Registro correcto!');document.location.href='LogIn.php';</script>"; 
                                        }//cierra registro en db
                                    
                                    } //cierra usuario existente
                                }
                                
                            } //cierra conexión
                        } else {
                            echo "<script>alert('Email no corresponde con el tipo de usuario.')</script>";
                        }
                    }
                }
            }
        }
    }
?>