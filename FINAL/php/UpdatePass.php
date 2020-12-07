<?php
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['password_tmp']==1){ 
        
    # usuario registrado con contraseña temporal
    
    ?>
    <html>
        <head>
          <?php include '../html/Head.html'?>
            <script src="../js/jquery-3.4.1.min.js"></script>
            <script src="../js/ShowImageInForm.js"></script>
        </head>
        <body>
          
        <?php include "../php/Menu.php"; ?> 
        <section class="main" id="s1">
            <div>
                <h2>Cambiar contraseña</h2><br/><br/>
                <form id='fquestion' name='fquestion' enctype='multipart/form-data' method='POST'><center>
                    <table>
                        <tr>
                            <td>
                                Ingrese la nueva contraseña:
                            </td>
                            <td>
                                <input type="password" name="new_pass" id="new_pass" size="60" >
                            </td>
                        </tr>
                    </table>
                    </center>
                    <br/><br/><input type="submit" name="submit" id="submit" value="Cambiar contraseña"/>
                </form>
                <br/><br/><br/>
          </section>
          <?php include '../html/Footer.html' ?>
        </body>
        </html>
        
    <?php
        if(isset($_POST["submit"])) {
            if(isset($_POST["new_pass"])) { 
                $new_pass = $_POST["new_pass"];
            }
            //ABRO LA CONEXIÓN
            include 'DbConfig.php';
            $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
            
            if (!$mysqli) {
                die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
            } else {
                $new_pass = sha1($new_pass);
                $sql2="UPDATE usuarios SET password_tmp = 0, password = ? WHERE email = ? ;";
                        if($stmt = mysqli_prepare($mysqli,$sql2)){
                            mysqli_stmt_bind_param($stmt, "ss", $new_pass, $_SESSION['user']);
                            mysqli_stmt_execute($stmt);
                        }
                    
                    mysqli_close($mysqli);
                    
                    $_SESSION['password_tmp']=0;
                    
                    echo "<script>alert('Contraseña modificada con éxito.');document.location.href='Layout.php';</script>";
            }
        }
    
    } else if (isset($_SESSION['user'])) {
        
        # usuario logueado que cambia su contraseña
    ?>
    
    <html>
        <head>
          <?php include '../html/Head.html'?>
            <script src="../js/jquery-3.4.1.min.js"></script>
            <script src="../js/ShowImageInForm.js"></script>
        </head>
        <body>
          
        <?php include "Menu.php"; ?> 
        <section class="main" id="s1">
            <div>
                <h2>Cambiar contraseña</h2><h3>Deberá volver a ingresar.</h3><br/><br/>
                <form id='fquestion' name='fquestion' enctype='multipart/form-data' method='POST'><center>
                    <table>
                        <tr>
                            <td>
                                Ingrese la nueva contraseña:
                            </td>
                            <td>
                                <input type="password" name="new_pass" id="new_pass" size="60" >
                            </td>
                        </tr>
                    </table>
                    </center>
                    <br/><br/><input type="submit" name="submit" id="submit" value="Cambiar contraseña"/>
                </form>
                <br/><br/><br/>
          </section>
          <?php include '../html/Footer.html' ?>
        </body>
        </html>
        
    <?php
        if(isset($_POST["submit"])) {
            if(isset($_POST["new_pass"])) { 
                $new_pass = $_POST["new_pass"];
            }
            //ABRO LA CONEXIÓN
            include 'DbConfig.php';
            $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
            
            if (!$mysqli) {
                die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
            } else {
                $new_pass = sha1($new_pass);
                $sql2="UPDATE usuarios SET password_tmp = 0, password = ? WHERE email = ? ;";
                        if($stmt = mysqli_prepare($mysqli,$sql2)){
                            mysqli_stmt_bind_param($stmt, "ss", $new_pass, $_SESSION['user']);
                            mysqli_stmt_execute($stmt);
                        }
                    
                    mysqli_close($mysqli);
                    
                    $_SESSION['password_tmp']=0;
                    
                    echo "<script>alert('Contraseña modificada con éxito.');document.location.href='LogOut.php?destroy';</script>";
            }
        }
    } else {
        
        # usuario no registrado
        echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>