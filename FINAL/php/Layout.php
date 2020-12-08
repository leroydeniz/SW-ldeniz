<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
      <?php include '../html/Head.html';?>
		
		<!-- CSS only -->
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="../bootstrap/css/style.css" rel="stylesheet">
		<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
		
		
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/scripts.js"></script>
		
    </head>
    <body>
        <?php
            include "../php/Menu.php";
        ?>
        <section class="main" id="s1">
            <div class="container-fluid">
    
                <h2>Quiz: el juego de las preguntas</h2><br/><br/>
                <img src="../images/bkgr.webp" style="max-width:800px;" alt="background">
            
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>