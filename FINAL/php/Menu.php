<?php

    if (isset($_SESSION['user'])) {
        echo "<div id='page-wrap'> <header class='main' id='h1'>";
    
			# si está registrado se trae de la base de datos y se decodifica en base64
			# si está registrado con google, se trae de la sesión
			# si no tiene fotos se muestra la imagen por default
            if($_SESSION['foto']!=null) {
                $foto = "data:image;base64,".$_SESSION['foto'];
            } else if ($_SESSION['foto_google']!=null) {
				$foto = $_SESSION['foto_google'];
			} else {
                $foto = "../images/anonymus.jpg";
            }
		
		
			# si está logueado con google no se le permite modificar la contraseña
			if($_SESSION['byGoogle']==1) {
				$modificar_pass = "";
			} else {
				$modificar_pass = "<a href='UpdatePass.php'> <button type='button' class='btn btn-primary'> Modificar contraseña &nbsp; <i class='icon-chevron-right'></i></button></a> &nbsp;&nbsp; ";
			}
		
            
            if ( $_SESSION['tipo_usuario'] == 'profesor' ) {
           
                if ( $_SESSION['admin'] == 0 ) {
           
                    echo "<img style='max-width:120px; max-height:60px;' alt='imagen pregunta' src='".$foto."'/><br/><br/><span class='right'>Usuario: ".$_SESSION['user']."</span><br/><span class='right'>Ultimo acceso: ".$_SESSION['ultimo_acceso']."</span><br/><span class='right'>Rol: Profesor</span>
                        <span class='right'><br/><br/>".$modificar_pass."<a href='LogOut.php?destroy'> <button type='button' class='btn btn-primary'> Logout &nbsp; <i class='icon-chevron-right'></i></button></a></span>
        
                        </header>
        
                        <nav class='main' id='n1' role='navigation'>
                            <span><a href='Layout.php'>Inicio</a></span>
                            <span><a href='HandlingQuizesAjax.php'> Gestionar preguntas</a></span>
                            <span><a href='ClientGetQuestion.php'> Obtener datos preguntas</a></span>
                            <span><a href='Credits.php'>Creditos</a></span>
                        </nav>";
        
                } else {
                    
                    echo "<img style='max-width:120px; max-height:60px;' alt='imagen pregunta' src='".$foto."'/><br/><br/><span class='right'>Usuario: ".$_SESSION['user']."</span><br/><span class='right'>Ultimo acceso: ".$_SESSION['ultimo_acceso']."</span><br/><span class='right'>Rol: Administrador</span>
                        <span class='right'><br/><br/>".$modificar_pass."<a href='LogOut.php?destroy'><button type='button' class='btn btn-primary'> Logout &nbsp; <i class='icon-chevron-right'></i></button></a></span>
        
                        </header>
        
                        <nav class='main' id='n1' role='navigation'>
                            <span><a href='Layout.php'>Inicio</a></span>
                            <span><a href='HandlingAccounts.php'> Gestionar usuarios</a></span>
                            <span><a href='Credits.php'>Creditos</a></span>
                        </nav>";
        
                }
    
            } else {
                
                echo "<img style='max-width:120px; max-height:60px;' alt='imagen pregunta' src='".$foto."'/><br/><br/><span class='right'>Usuario: ".$_SESSION['user']."</span><br/><span class='right'>Ultimo acceso: ".$_SESSION['ultimo_acceso']."</span><br/><span class='right'>Rol: Alumno</span>
                    <span class='right'><br/><br/>".$modificar_pass."<a href='LogOut.php?destroy'><button type='button' class='btn btn-primary'> Logout &nbsp; <i class='icon-chevron-right'></i></button></a></span>
    
                    </header>
    
                    <nav class='main' id='n1' role='navigation'>
                        <span><a href='Layout.php'>Inicio</a></span>
                            <span><a href='HandlingQuizesAjax.php'> Gestionar preguntas</a></span>
                        <span><a href='Credits.php'>Creditos</a></span>
                    </nav>";
                
            } 
    } else {
		
		require ("../vendor/autoload.php");
		require ("DbConfig.php");
	
		# Datos de la aplicación de google
		$cliente = new Google_Client();
		$cliente->setClientId('1014449853200-h4kgn74v3npffdr6imnrjod6f9m1b5nt.apps.googleusercontent.com');
		$cliente->setClientSecret('24vlMrfrvy0ppEdcF5JWl8-F');
		$cliente->setRedirectUri('https://leroydeniz.com/SW/php/LogInSocial.php');
		$cliente->addScope("email");
		$cliente->addScope("profile");
	
		# Url para el acceso
		$auth_url = $cliente->createAuthUrl();
		
        echo "<div id='page-wrap'>
        <header class='main' id='h1'>
            <img style='max-width:120px; max-height:60px;' alt='anonimo' src='../images/anonymus.jpg'/><br/><br/>
            <span class='right menusup'>Anónimo</span><br/><br/>
            <span class='right menusup'><a href='SignUp.php'><button type='button' class='btn btn-primary'> Registro &nbsp; <i class='icon-chevron-right'></i></button></a></span>
            <span class='right menusup'><a href='LogIn.php'><button type='button' class='btn btn-primary'> Login &nbsp; <i class='icon-chevron-right'></i></button></a></span>
            <span class='right menusup'><a href='$auth_url'><button type='button' class='btn btn-primary'> Login with Google &nbsp; <i class='icon-google-plus'></i></button></a></span>
        
        </header>
        <nav class='main' id='n1' role='navigation'>
          <span><a href='Layout.php'>Inicio</a></span>
          <span><a href='Credits.php'>Creditos</a></span>
        </nav>";
    }
       

?>