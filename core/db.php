<?php 

    function db(){
        try{ 
            $dsn = "pgsql:host=localhost;port=5432;dbname=loja;";
            $conn  = new \PDO($dsn, "postgres", "123post",
                array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_EMULATE_PREPARES   => false,
                    \PDO::ATTR_PERSISTENT         => true, 
                    \PDO::ATTR_AUTOCOMMIT         => false
                )
            );
        }catch( Exception $e ){ 
            die("Houve um erro crítico. <br> <strong>Código do Erro:</strong> #{$e->getCode()}");
        }

        return $conn;
    }

?>