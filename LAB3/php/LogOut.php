<?php
    if(isset($_GET["email"])) { 
        $email = $_GET["email"];
        echo "<script>alert(\"¡Adiós $email!\");document.location.href='Layout.php';</script>"; 
    } else {
        echo "<script>document.location.href='Layout.php';</script>"; 
    }
?>








