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
            
 
            $query = "INSERT INTO produtos.produtos ( nome, preco_unidade, tipo_id, data_registro ) VALUES ( :nome, :preco_unidade, :tipo_id, :data_registro ) "; 
            $stmt = $this -> _db -> prepare( $query );

            $stmt -> bindValue(':nome', $product->nome); 
            $stmt -> bindValue(':preco_unidade', $product->preco_unidade); 
            $stmt -> bindValue(':data_registro', $product->data_registro); 
            $stmt -> bindValue(':tipo_id', $product->tipo_id); 

            if( !$stmt ->  execute() ){
                return false;
            }

            return $this -> _db -> lastInsertId();

        }

        public function count_all(  ){
            $query = "SELECT count(id) as total FROM produtos.produtos "; 
            $stmt = $this -> _db -> prepare( $query );  

            if( ! $stmt ->  execute()  ){
                return null;
            }

            if( $r = $stmt->fetch() ){ 
                return $r['total'] ?? 0;
            }else{
                return 0;
            }
        }

        public function fetch_by_id( $id ){
            $query = "SELECT * FROM produtos.produtos WHERE id = :id "; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> bindValue(':id', $id);  

            if( ! $stmt ->  execute()  ){
                return null;
            }

            if( $r = $stmt->fetch() ){
                $ProductEntity = new ProductEntity();
                foreach( $r  as $key => $value ){
                    $ProductEntity -> $key = $value;
                }
                return $ProductEntity;
            }else{
                return null;
            }
        }

        /*
            Pegar todas as ordens/vendas
        */
        public function fetch_all(){ 
 
            $query = "
            SELECT p.*, t.nome AS produto_tipo_nome, t.percentual_imposto AS produto_percentual_imposto FROM produtos.produtos AS p 
                LEFT JOIN produtos.produto_tipo AS t ON t.id = p.tipo_id
            ORDER BY id DESC"; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> execute();
            if( $results = $stmt->fetchAll() ){
                foreach( $results as &$result ){
                    $productEntity = new ProductEntity();
                    foreach( $result  as $key => $value ){ 
                        $productEntity -> $key = $value;
                    }
                    $result = $productEntity;
                }
                return $results;
            }
            return [];
        }

    }

?>