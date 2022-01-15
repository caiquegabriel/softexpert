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

            foreach( $product -> get_vars() as $key => $value ){
                if( in_array( $key, ['nome', 'preco_unidade'] ) ) {
                    if( empty( $value ) )
                        return;
                }
            }
 
            $query = "INSERT INTO produtos.produtos ( nome, data_registro, preco_unidade ) VALUES ( :nome, :data_registro, :preco_unidade ) "; 
            $stmt = $this -> _db -> prepare( $query );

            $stmt -> bindValue(':nome', $product->nome);
            $stmt -> bindValue(':data_registro', $product->data_registro);
            $stmt -> bindValue(':preco_unidade', $product->preco_unidade); 

            $stmt ->  execute();

            return $this -> _db -> lastInsertId();

        }

    }

?>