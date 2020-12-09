<?php 
    session_start();
    if (ISSET($_SESSION['user']) && $_SESSION['admin']==0){
        
        if(!$xml = simplexml_load_file('../xml/UserCounter.xml')){
            echo "<script>alert('No se ha podido cargar el XML en CountXMLUsers.php');</script>";
        } else {
            echo "Total de usuarios en línea: ".$xml->totalOfUsers;
        }
    
    } else {
        echo "<script>alert('No tiene permisos para acceder a esta página.');document.location.href='Layout.php';</script>";
    }
?>