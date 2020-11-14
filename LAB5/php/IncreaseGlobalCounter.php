<?php
    $email = $_GET['email'];
    if(!$xml = simplexml_load_file('../xml/UserCounter.xml')){
        echo "<script>alert('No se ha podido cargar el XML en IncreaseGlobalCounter.php');</script>";
    } else {
        # toma el primer y único elemento del xml que lleva el control del total de usuarios y le incrementa uno
            $suma = $xml->totalOfUsers;
            $suma = $suma + 1;
            $xml->totalOfUsers = $suma;
        # guardo el nuevo xml
        $xml->asXML('../xml/UserCounter.xml');
    }
    echo "<script>document.location.href='Layout.php?email=$email';</script>"; 
?>