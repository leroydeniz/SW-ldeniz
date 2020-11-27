<?php
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['tipo_usuario']=="profesor" && $_SESSION['admin']==1) {
        
        if(isset($_GET['email'])){
            $usuario = $_GET['email'];
            
            //ABRO LA CONEXIÓN
            include 'DbConfig.php';
            $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
            
            if (!$mysqli) {
                die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
            } else {
                
                $sql1 = "SELECT * FROM usuarios where email= ? ;";
                //verifico la conexión y la estructura inicial de la sentencia 
                if($stmt = mysqli_prepare($mysqli,$sql1)){
                    # Se ligan las variables a los campos correspondientes: $stmt(estructura de sentencia), orden de atributos ssdf (string, string, int, float), variables separadas por ' , '
                    mysqli_stmt_bind_param($stmt, "s", $usuario);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_array($result);
                    
                    if ($row['estado'] == 1) {
                        $estado = 0;
                    } else {
                        $estado = 1;
                    }
                        
                    $sql2 = "UPDATE usuarios SET estado = $estado WHERE email = '$usuario' ;";
                    
                    if($stmt = mysqli_prepare($mysqli,$sql2)){
                        mysqli_stmt_bind_param($stmt, "ds", $estado, $usuario);
                        mysqli_stmt_execute($stmt);
                    }
                    mysqli_close($mysqli);
                    
                    echo "<script>document.location.href='HandlingAccounts.php';</script>"; 
                    }
                }
                    
        }#cierra proceso de guardado
    } else {
        echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>