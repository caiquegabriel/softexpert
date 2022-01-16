<?php 

    namespace repositories; 

    use entities\OrderItem as OrderItemEntity;

    class OrderItem{ 

        protected $_db;

        public function __construct( $db ){
            $this -> _db = $db;
        }  

        /*
            Registro de um produto na base.
        */
        public function register( OrderItemEntity $item ){
            
 
            $query = "INSERT INTO produtos.venda_item ( 
                venda_id, 
                produto_id,
                quantidade, 
                produto_preco, 
                produto_percentual_imposto 
            ) VALUES ( 
                :venda_id, 
                :produto_id, 
                :quantidade, 
                :produto_preco,
                :produto_percentual_imposto 
            ) "; 
            $stmt = $this -> _db -> prepare( $query );

            $stmt -> bindValue(':venda_id', $item->venda_id); 
            $stmt -> bindValue(':produto_id', $item->produto_id); 
            $stmt -> bindValue(':quantidade', $item->quantidade); 
            $stmt -> bindValue(':produto_preco', $item->produto_preco); 
            $stmt -> bindValue(':produto_percentual_imposto', $item->produto_percentual_imposto); 

            if( !$stmt ->  execute() ){
                return false;
            }

            return $this -> _db -> lastInsertId(); 
        }

        public function count_items_by_order_id( $id ){
            $query = "SELECT SUM(quantidade) as total FROM produtos.venda_item WHERE venda_id = :venda_id "; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> bindValue(':venda_id', $id);  

            if( ! $stmt ->  execute()  ){
                return null;
            }

            if( $r = $stmt->fetch() ){ 
                return $r['total'] ?? 0;
            }else{
                return 0;
            }
        }

        public function fetch_items_by_order_id( $venda_id ){
            $query = "SELECT * FROM produtos.venda_item WHERE venda_id = :venda_id "; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> bindValue( ':venda_id', $venda_id );
            $stmt -> execute();
            if( $results = $stmt->fetchAll() ){
                foreach( $results as &$result ){
                    $orderItemEntity = new OrderItemEntity();
                    foreach( $result  as $key => $value ){
                        $orderItemEntity -> $key = $value;
                    }
                    $result = $orderItemEntity;
                }
                return $results;
            }
            return [];
        }

    }

?>