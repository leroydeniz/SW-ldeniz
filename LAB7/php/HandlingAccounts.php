<?php 
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['tipo_usuario']=="profesor" && $_SESSION['admin']==1){
    ?>

        <!DOCTYPE html>
        <html>
        <head>
          <?php include '../html/Head.html'?>
          <?php include '../php/DbConfig.php'?>
        </head>
        <body>
          <
          <?php
            include "Menu.php";
          ?>
          <section class="main" id="s1"><center>
            <div id="tablausuarios">
                
            <style>
                table, th, td { 
                        border: 2px solid red; 
                        text-align:center; 
                    } 
                th, td { 
                    padding: 20px; 
                    background-color:none; 
                } 
            </style> 

<?php
    //ABRO LA CONEXIÓN
    $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
    if (!$mysqli) {
        die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
    } else {
        $sql = "SELECT * FROM usuarios;";
        $resultado = mysqli_query ($mysqli,$sql);
        echo "<h2>Gestión de usuarios</h2><br/><br/><br/>";
        
        //CABECERA DELA TABLA
        echo "<table border=1>";
        echo "    <tr><th><b>Email</b></th><th><b>Rol</b></th><th><b>Pass</b></th><th><b>Imagen</b></th><th><b>Estado</b></th><th><b>Bloqueo</b></th><th><b>Borrar</b></th></tr>";
        
        while( $row = mysqli_fetch_array( $resultado )){
            
            if ($row['admin'] == 1) {
                $row['tipo_usuario']="administrador";
                $botonCambiarEstado = "<img src='../images/not.png' style='max-width:20px;'>";
                $botonEliminar = "<img src='../images/not.png' style='max-width:20px;'>";
            } else {
                $botonCambiarEstado = "<a href='ChangeUserState.php?email=".$row['email']."'><input type='button' value='Cambiar estado'/></a>";
                $botonEliminar = "<a href='RemoveUser.php?email=".$row['email']."'><input type='button' value='Eliminar'/></a>";
            }
            
            if ($row['estado'] == 1) {
                $row['estado'] = 'Activo';
            } else {
                $row['estado'] = 'Bloqueado';
            }
            
            if ($row['foto']!=NULL){
                echo "<tr>
                        <td>".$row['email']."</td>
                        <td>".$row['tipo_usuario']."</td>
                        <td>".$row['password']."</td>
                        <td><img style='max-width:120px; max-height:80px;' alt='imagen usuario' src='data:image;base64,".$row['foto']."'/></td>
                        <td>".$row['estado']."</td>
                        <td>$botonCambiarEstado</td>
                        <td>$botonEliminar</td>
                    </tr>";
            } else {
                echo "<tr>
                        <td>".$row['email']."</td>
                        <td>".$row['tipo_usuario']."</td>
                        <td>".$row['password']."</td>
                        <td></td>
                        <td>".$row['estado']."</td>
                        <td>$botonCambiarEstado</td>
                        <td>$botonEliminar</td>
                    </tr>";
            }
            
        }
        
        echo "</table>";
        
        // CIERRO LA CONEXIÓN
        mysqli_close($mysqli);
    }
?>
        
            </div><br/><br/><br/><br/><br/><br/><br/>
          </section>
          <?php include '../html/Footer.html' ?>
        </body>
        </html>

    <?php
    } else {
        echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>