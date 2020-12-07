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
        </head>
        <body>
          <?php
            include "../php/Menu.php";
          ?>
          <section class="main" id="s1">
            <div>
        
              <h2>Obtener datos de preguntas</h2><br/><br/>
              
              ID de pregunta: <input type='text' size='6' id='idpregunta'/><br/><br/><input type='button' id='btn-mostrar' value='Buscar datos' onclick='BuscarDatosPregunta()'/><br/><br/> 
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