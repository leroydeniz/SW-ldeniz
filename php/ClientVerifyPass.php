<?php

    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    
    $password = $_GET["password"];
    $ticket = $_GET["ticket"];
    
    
    $soapclient = new nusoap_client('http://leroydeniz.com/SW/php/VerifyPassWS.php?wsdl',true);
    $result = $soapclient->call('ValidarPasswordWS', array( 'x'=>$password,'y'=>1010) );
    
    $err = $soapclient->getError();
    if ($err) {
        // Display the error
        //echo '<br/><h2>Constructor error</h2>' . $err . '<br/><br/>'; #descomentar si no verifica bien.
        echo "&nbsp";
        // At this point, you know the call that follows will fail
        exit();
    } else {
        echo $result;
    }
    
?>