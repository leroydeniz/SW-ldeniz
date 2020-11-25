 <?php
 
    require_once('../lib/nusoap.php'); 
    require_once('../lib/class.wsdlcache.php');
 
    if ( isset ($_GET[ 'pId' ] ) ) {
        $pId = $_GET[ 'pId' ];
        
        //creamos el objeto de tipo soapclient.
        $soapclient = new nusoap_client ( 'https://sw-ldeniz.000webhostapp.com/Lab6/php/GetQuestionWS.php?wsdl',true);
        
        //Llamamos la función que habíamos implementado en el Web Service e imprimimos lo que nos devuelve
        $result = $soapclient->call('ObtenerPregunta', array('y'=>$pId));
        
        if ($error = $soapclient->getError()){
            echo "ERROR EN ClientGetQuestionWS.php: ".$error;
            
            #echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>'; 
            #echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>'; 
            #echo '<h2>Debug</h2>';
            #echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>'; 
        } else {
        
            if ( $result['autor'] == null ) {
                echo "<p style='color:red;'>No existe la pregunta con ID $pId.</p>";
            } else {
                echo "<p style='color:blue;'>ID: $pId <br/>Enunciado: ".$result['enunciado']."<br/>Respuesta correcta: ".$result['respuesta_correcta']."<br/>Autor: ".$result['autor']."</p>";
            }
        }
        
    }
    


?>