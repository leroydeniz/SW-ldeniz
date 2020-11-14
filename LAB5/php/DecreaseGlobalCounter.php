<?php
    if(!$xml = simplexml_load_file('../xml/UserCounter.xml')){
        echo "<script>alert('No se ha podido cargar el XML en DecreaseGlobalCounter.php');</script>";
    } else {
        # toma el primer y único elemento del xml que lleva el control del total de usuarios y le decremento uno
        foreach ($xml as $total) {
            $suma = $xml->totalOfUsers;
            $suma = $suma - 1;
            $xml->totalOfUsers = $suma;
        }
        # para evitar que el contador pueda ser negativo, lo dejo en 0
        if($total->totalOfUsers<0) {
            $total->totalOfUsers=0;
        }
        # guardo el nuevo xml
        $xml->asXML('../xml/UserCounter.xml');
    }
    echo "<script>document.location.href='Layout.php';</script>"; 
?>