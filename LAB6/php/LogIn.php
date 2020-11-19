<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php include '../php/DbConfig.php'?>
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
        
        # ABRO LA CONEXIÓN
        $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
        } else {
            $sql = "SELECT * FROM usuarios where email=? AND password=?;";
            //verifico la conexión y la estructura inicial de la sentencia 
            if($stmt = mysqli_prepare($mysqli,$sql)){
                # Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
                mysqli_stmt_bind_param($stmt, "ss", $email, $password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if (mysqli_num_rows($result) == 1) {
                    echo "<script>alert(\"¡Bienvenido!\");document.location.href='IncreaseGlobalCounter.php?email=$email';</script>"; 
                } else {
                    echo "<script>alert(\"Usuario o contraseña incorrectos\");document.location.href='LogIn.php';</script>"; 
                }
                mysqli_close($mysqli);
            }
        }
        
    }
?>








