<?php 
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['admin']==1){
    ?>

        <!DOCTYPE html>
        <html>
        <head>
          <?php include '../html/Head.html'?>
          <?php include '../php/DbConfig.php'?>
			
			<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
			<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
			
        </head>
        <body>
          <?php
            include "Menu.php";
          ?>
          <section class="main" id="s1"><center>
            <div id="tablausuarios">
                
            <style>
                table, th, td { 
					text-align:center; 
					margin-top: auto;
					margin-bottom: auto;
				} 
                th, td { 
                    padding: 20px;
					text-align: center;
					margin-top: auto;
					margin-bottom: auto;
                } 
            </style> 

<?php
    //ABRO LA CONEXIÓN
    $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
		
	#Usa la base de datos como utf8
	mysqli_set_charset($mysqli, 'utf8');
		
    if (!$mysqli) {
        die("<center><br/><br/><h2> Ha habido un problema con la conexión a la base de datos!</h2><br/><br/><img src='../images/not.png' style='max-width:200px;'><br/><br/><br/>Detalle del error: ".mysqli_connect_error()."</center>");
    } else {
        $sql = "SELECT * FROM usuarios;";
        $resultado = mysqli_query ($mysqli,$sql);
        echo "<h2>Gestión de usuarios</h2><br/><br/><br/>";
        
        //CABECERA DELA TABLA
        echo "<table class='table table-hover'>";
        echo "    <thead class='thead-dark'><th scope='col'><b>Email</b></th><th scope='col'><b>Rol</b></th><th scope='col'><b>Pass</b></th><th scope='col'><b>Imagen</b></th><th scope='col'><b>Estado</b></th><th scope='col'><b>Bloqueo</b></th><th scope='col'><b>Borrar</b></th></thead>";
        
        while( $row = mysqli_fetch_array( $resultado )){
            
            if ($row['admin'] == 1) {
                $row['tipo_usuario']="administrador";
                $botonCambiarEstado = "<img src='../images/not.png' style='max-width:20px;'>";
                $botonEliminar = "<img src='../images/not.png' style='max-width:20px;'>";
            } else {
                $botonCambiarEstado = "<a href='ChangeUserState.php?email=".$row['email']."'><input type='button' class='btn btn-success' value='Cambiar estado'/></a>";
                $botonEliminar = "<a href='RemoveUser.php?email=".$row['email']."'><input type='button' class='btn btn-danger' value='Eliminar'/></a>";
            }
            
            if ($row['estado'] == 1) {
                $row['estado'] = 'Activo';
            } else {
                $row['estado'] = 'Bloqueado';
            }
            
            if ($row['foto']!=NULL){
                echo "<tr>
                        <td class='align-middle'>".$row['email']."</td>
                        <td class='align-middle'>".$row['tipo_usuario']."</td>
                        <td class='align-middle'>".$row['password']."</td>
                        <td class='align-middle'><img style='max-width:120px; max-height:80px;' alt='imagen usuario' src='data:image;base64,".$row['foto']."'/></td>
                        <td class='align-middle'>".$row['estado']."</td>
                        <td class='align-middle'>$botonCambiarEstado</td>
                        <td class='align-middle'>$botonEliminar</td>
                    </tr>";
            } else {
                echo "<tr>
                        <td class='align-middle'>".$row['email']."</td>
                        <td class='align-middle'>".$row['tipo_usuario']."</td>
                        <td class='align-middle'>".$row['password']."</td>
                        <td class='align-middle'></td>
                        <td class='align-middle'>".$row['estado']."</td>
                        <td class='align-middle'>$botonCambiarEstado</td>
                        <td class='align-middle'>$botonEliminar</td>
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