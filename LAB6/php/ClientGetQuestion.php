<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ClientGetQuestion.js"></script>
</head>
<body>
  <?php
    if(isset($_GET['email'])){
        include "../php/Menus-registrado.php";
    } else {
        include "../php/Menus.php";
    }
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
