<?php 

    namespace repositories; 

    use entities\ProductType as ProductTypeEntity;

    class ProductType{ 

        protected $_db;

        public function __construct( $db ){
            $this -> _db = $db;
        }  

        /*
            Registro de um produto na base.
        */
        public function register( ProductTypeEntity $type ){
            
 
            $query = "INSERT INTO produtos.produto_tipo ( percentual_imposto, data_registro, nome, cod) VALUES ( :percentual_imposto, :data_registro, :nome, :cod) "; 
            $stmt = $this -> _db -> prepare( $query );

            $stmt -> bindValue(':percentual_imposto', $type->percentual_imposto);  
            $stmt -> bindValue(':data_registro', $type->data_registro);  
            $stmt -> bindValue(':nome', $type->nome);  
            $stmt -> bindValue(':cod', $type->cod);  

            if( !$stmt ->  execute() ){
                return false;
            }

            return $this -> _db -> lastInsertId();

        }

        public function count_all(  ){
            $query = "SELECT count(id) as total FROM produtos.produto_tipo "; 
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

        public function fetch_by_id( $tipo_id ){
            $query = "SELECT * FROM produtos.produto_tipo WHERE id = :id "; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> bindValue(':id', $tipo_id);  

            if( ! $stmt ->  execute()  ){
                return null;
            }

            if( $r = $stmt->fetch() ){
                $ProductTypeEntity = new ProductTypeEntity();
                foreach( $r  as $key => $value ){
                    $ProductTypeEntity -> $key = $value;
                }
                return $ProductTypeEntity;
            }else{
                return null;
            }
        }

        public function fetch_by_cod( $tipo_cod ){
            $query = "SELECT * FROM produtos.produto_tipo WHERE cod = :cod "; 
            $stmt = $this -> _db -> prepare( $query ); 
            $stmt -> bindValue(':cod', $tipo_cod);  

            if( ! $stmt ->  execute()  ){
                return null;
            }

            if( $r = $stmt->fetch() ){
                $ProductTypeEntity = new ProductTypeEntity();
                foreach( $r  as $key => $value ){
                    $ProductTypeEntity -> $key = $value;
                }
                return $ProductTypeEntity;
            }else{
                return null;
            }
        }

    }

?>