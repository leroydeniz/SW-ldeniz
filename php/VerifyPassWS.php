<?php

    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    
    $ns="http://localhost/nusoap-0.9.5/samples";
    $server = new soap_server;
    $server->configureWSDL('ValidarPasswordWS',$ns);
    $server->wsdl->schemaTargetNamespace=$ns;
    
    $server->register('ValidarPasswordWS',
    array('x'=>'xsd:string','y'=>'xsd:int'),
    array('z'=>'xsd:string'),
    $ns);
    
    function ValidarPasswordWS ($x, $y){
    	
    	if($y != 1010){
    		return 'SIN SERVICIO';
    	}else{
    		$pagina = file_get_contents('../txt/toppasswords.txt');
    		if( strpos($pagina, $x) != false || strlen($x)<6) {
    			return 'INVALIDA';
    		} else {
    			return 'VALIDA';
    		}
    	}
    }
    
    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
    $server->service($HTTP_RAW_POST_DATA);

?>