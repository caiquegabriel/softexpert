<?php 

    namespace repositories; 

    use entities\Order as OrderEntity;

    class Order{ 

        protected $_db;

        public function __construct( $db ){
            $this -> _db = $db;
        }  

        /*
            Registro de um produto na base.
        */
        public function register( OrderEntity $order ){ 
 
            $query = "INSERT INTO produtos.venda ( 
                data_registro
            ) VALUES ( 
                :data_registro
            ) "; 
            $stmt = $this -> _db -> prepare( $query );

            $stmt -> bindValue(':data_registro', $order->data_registro);  

            if( !$stmt ->  execute() ){
                return false;
            }

            return $this -> _db -> lastInsertId(); 
        }

        public function delete_by_id( $order_id){ 
 
            $query = "DELETE FROM produtos.venda WHERE id = :id "; 
            $stmt = $this -> _db -> prepare( $query );

            $stmt -> bindValue(':id', $order_id );  

            if( !$stmt ->  execute() ){
                return false;
            } 
            return true;
        }

    }

?>