<?php 
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['admin']==0 && $_SESSION['tipo_usuario']=='profesor'){
    ?>
        <!DOCTYPE html>
        <html>
        <head>
          <?php include '../html/Head.html'?>
            <script src="../js/jquery-3.4.1.min.js"></script>
            <script src="../js/ClientGetQuestion.js"></script>
			
			<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
			<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
			
        </head>
        <body>
          <?php
            include "Menu.php";
          ?>
          <section class="main" id="s1">
            <div>
        
              <h2>Obtener datos de preguntas</h2><br/><br/>
              
              <center><input type='text' class="form-control" placeholder="ID de pregunta" size='6' id='idpregunta' style="text-align:center;max-width:10%;" /></center><br/><br/><input type='button' id='btn-mostrar' class='btn btn-primary' value='Buscar datos' onclick='BuscarDatosPregunta()'/><br/><br/> 
              <div id='div-info'></div>
                
            </div>
          </section>
          <?php include '../html/Footer.html' ?>
        </body>
        </html>
    <?php
    } else {
        echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>