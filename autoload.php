<?php 

    spl_autoload_register(
        function ( $class ){
            if(!is_string( $class))
                return;
            $file =  str_replace( '\\', "/", __DIR__ . "/" .  $class ) . '.php';
            if(file_exists($file )){
                require_once(  $file  );
            }
        }
    );

?>