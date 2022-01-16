<?php 

    function db(){
        try{ 
            $dsn = "pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";";
            $conn  = new \PDO($dsn, DB_USER, DB_USER_PASS,
                array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_EMULATE_PREPARES   => false,
                    \PDO::ATTR_PERSISTENT         => true, 
                    \PDO::ATTR_AUTOCOMMIT         => false
                )
            );
        }catch( Exception $e ){ 
            die("Houve um erro crítico. <br> <strong>Código do Erro:</strong> #{$e->getCode()}<br><br> Mensagem: " . $e->getMessage());
        }

        return $conn;
    }

?>