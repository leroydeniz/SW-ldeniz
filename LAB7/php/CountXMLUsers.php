<?php
      if(!$xml = simplexml_load_file('../xml/UserCounter.xml')){
        echo "<script>alert('No se ha podido cargar el XML en CountXMLUsers.php');</script>";
    } else {
        echo "Total de usuarios en línea: ".$xml->totalOfUsers;
    }
    
?>