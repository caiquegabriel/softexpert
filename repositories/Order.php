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

        /*
            Pegar todas as ordens/vendas
        */
        public function fetch_all(){ 
 
            $query = "SELECT * FROM produtos.venda ORDER BY id DESC"; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> execute();
            if( $results = $stmt->fetchAll() ){
                foreach( $results as &$result ){
                    $orderEntity = new OrderEntity();
                    foreach( $result  as $key => $value ){
                        $orderEntity -> $key = $value;
                    }
                    $result = $orderEntity;
                }
                return $results;
            }
            return [];
        }

        public function fetch_by_id( $id ){
            $query = "SELECT * FROM produtos.venda WHERE id = :id "; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> bindValue(':id', $id);  

            if( ! $stmt ->  execute()  ){
                return null;
            }

            if( $r = $stmt->fetch() ){
                $OrderEntity = new OrderEntity();
                foreach( $r  as $key => $value ){
                    $OrderEntity -> $key = $value;
                }
                return $OrderEntity;
            }else{
                return null;
            }
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