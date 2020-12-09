 <?php
 
    require_once('../lib/nusoap.php'); 
    require_once('../lib/class.wsdlcache.php');
 
    if ( isset ($_GET[ 'email' ] ) ) {
        $email = $_GET['email'];
        
        //creamos el objeto de tipo soapclient.
        $soapclient = new nusoap_client ( 'http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl',true);
        
        //Llamamos la función que habíamos implementado en el Web Service. //e imprimimos lo que nos devuelve
        $result = $soapclient->call('comprobar', array('x'=>$email));
        
        if ( $result == "NO" ){
            echo "<p style='color:red;'>Usuario no VIP.</p>";
        } else {
            echo "<p style='color:green;'>Usuario VIP.</p>";
        }
    
    }
 
    
    

?>