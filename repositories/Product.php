<?php 

    namespace repositories; 

    use entities\Product as ProductEntity;

    class Product{ 

        protected $_db;

        public function __construct( $db ){
            $this -> _db = $db;
        }  

        /*
            Registro de um produto na base.
        */
        public function register( ProductEntity $product ){
            
 
            $query = "INSERT INTO produtos.produtos ( nome, preco_unidade ) VALUES ( :nome, :preco_unidade ) "; 
            $stmt = $this -> _db -> prepare( $query );

            $stmt -> bindValue(':nome', $product->nome); 
            $stmt -> bindValue(':preco_unidade', $product->preco_unidade); 

            if( !$stmt ->  execute() ){
                return false;
            }

            return $this -> _db -> lastInsertId();

        }

    }

?>