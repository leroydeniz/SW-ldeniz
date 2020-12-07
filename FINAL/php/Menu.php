<?php

    if (isset($_SESSION['user'])) {
        echo "<div id='page-wrap'> <header class='main' id='h1'>";
    
            if($_SESSION['foto']!=null) {
                $foto = "data:image;base64,".$_SESSION['foto'];
            } else {
                $foto = "../images/anonymus.jpg";
            }
            
            if ( $_SESSION['tipo_usuario'] == 'profesor' ) {
           
                if ( $_SESSION['admin'] == 0 ) {
           
                    echo "<img style='max-width:120px; max-height:60px;' alt='imagen pregunta' src='".$foto."'/><br/><br/><span class='right'>Usuario: ".$_SESSION['user']."</span><br/><span class='right'>Ultimo acceso: ".$_SESSION['ultimo_acceso']."</span><br/><span class='right'>Rol: Profesor</span>
                        <span class='right'><br/><br/><a href='UpdatePass.php'>Modificar contraseña</a> &nbsp;&nbsp; <a href='LogOut.php?destroy'>Logout</a></span>
        
                        </header>
        
                        <nav class='main' id='n1' role='navigation'>
                            <span><a href='Layout.php'>Inicio</a></span>
                            <span><a href='HandlingQuizesAjax.php'> Gestionar preguntas</a></span>
                            <span><a href='ClientGetQuestion.php'> Obtener datos preguntas</a></span>
                            <span><a href='Credits.php'>Creditos</a></span>
                        </nav>";
        
                } else {
                    
                    echo "<img style='max-width:120px; max-height:60px;' alt='imagen pregunta' src='".$foto."'/><br/><br/><span class='right'>Usuario: ".$_SESSION['user']."</span><br/><span class='right'>Ultimo acceso: ".$_SESSION['ultimo_acceso']."</span><br/><span class='right'>Rol: Administrador</span>
                        <span class='right'><br/><br/><a href='UpdatePass.php'>Modificar contraseña</a> &nbsp;&nbsp; <a href='LogOut.php?destroy'>Logout</a></span>
        
                        </header>
        
                        <nav class='main' id='n1' role='navigation'>
                            <span><a href='Layout.php'>Inicio</a></span>
                            <span><a href='HandlingAccounts.php'> Gestionar usuarios</a></span>
                            <span><a href='Credits.php'>Creditos</a></span>
                        </nav>";
        
                }
    
            } else {
                
                echo "<img style='max-width:120px; max-height:60px;' alt='imagen pregunta' src='".$foto."'/><br/><br/><span class='right'>Usuario: ".$_SESSION['user']."</span><br/><span class='right'>Ultimo acceso: ".$_SESSION['ultimo_acceso']."</span><br/><span class='right'>Rol: Alumno</span>
                    <span class='right'><br/><br/><a href='UpdatePass.php'>Modificar contraseña</a> &nbsp;&nbsp; <a href='LogOut.php?destroy'>Logout</a></span>
    
                    </header>
    
                    <nav class='main' id='n1' role='navigation'>
                        <span><a href='Layout.php'>Inicio</a></span>
                            <span><a href='HandlingQuizesAjax.php'> Gestionar preguntas</a></span>
                        <span><a href='Credits.php'>Creditos</a></span>
                    </nav>";
                
            } 
    } else {
        echo "<div id='page-wrap'>
        <header class='main' id='h1'>
            <img style='max-width:120px; max-height:60px;' alt='anonimo' src='../images/anonymus.jpg'/><br/><br/>
            <span class='right menusup'>Anónimo</span><br/><br/>
            <span class='right menusup'><a href='SignUp.php'>Registro</a></span>
            <span class='right menusup'><a href='LogIn.php'>Login</a></span>
        
        </header>
        <nav class='main' id='n1' role='navigation'>
          <span><a href='Layout.php'>Inicio</a></span>
          <span><a href='#'>A Jugar! (próximamente)</a></span>
          <span><a href='Credits.php'>Creditos</a></span>
        </nav>";
    }
       

?>