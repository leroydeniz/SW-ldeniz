<?php

    
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    
    $ns="http://localhost/nusoap-0.9.5/samples";
    $server = new soap_server;
    $server->configureWSDL('ObtenerPreguntaWS',$ns);
    $server->wsdl->schemaTargetNamespace=$ns;
    
    
    $server->wsdl->addComplexType(
        'questionInfo',
        'complexType',
        'struct',
        'all',
        '',
        array(
            'autor' => array('name'=>'autor', 'type'=>'xsd:string'),
            'enunciado' => array('name'=>'enunciado', 'type'=>'xsd:string'),
            'respuesta_correcta' => array('name'=>'respuesta_correcta','type'=>'xsd:string')
        )
    );
    
        
        
        
    // Registramos el método y su parámetro de entrada
    $server->register('ObtenerPregunta',                // nombre método
        array('y' => 'xsd:int'),                        //  parametros entrantes al servicio
        array('z' => 'tns:questionInfo'),          // valor(es) retornado(s)
        $ns
        );
    
    
    
    function ObtenerPregunta ($y){
    	include 'DbConfig.php';
        $mysqli = mysqli_connect ($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            echo "<script>alert('".mysqli_connect_error()."')</script>";
        } else {
            $sql = "SELECT * FROM preguntas WHERE id =".$y;
            $resultado = mysqli_query ($mysqli,$sql);
            
            if ( mysqli_num_rows($resultado) == 1 ) {
                $row = mysqli_fetch_array( $resultado ); 
                    $email = $row['email'];
                    $enunciado = $row['enunciado'];
                    $respuesta_correcta = $row['respuesta_correcta'];
                return array( 'autor'=>$email, 'enunciado'=>$enunciado, 'respuesta_correcta'=>$respuesta_correcta );
            } else {
                return array( 'autor'=>'', 'enunciado'=>'', 'respuesta_correcta'=>''); #devolver los tres valores vacíos
            }
            
            // CIERRO LA CONEXIÓN
            mysqli_close($mysqli);
        }
        
    }
    
    
    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
    $server->service($HTTP_RAW_POST_DATA);

    
?>