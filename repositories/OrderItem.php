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

    }

?>