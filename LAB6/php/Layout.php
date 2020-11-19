<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
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

      <h2>Quiz: el juego de las preguntas</h2><br/><br/>
        
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
