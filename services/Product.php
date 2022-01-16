<?php 

    namespace services; 

    use services\Service;

    use entities\Product as ProductEntity;
    use repositories\Product as ProductRepository;
    use repositories\ProductType as ProductTypeRepository;

    class Product extends Service{ 

        protected $_db;

        public function __construct( $db ){
            $this -> _db = $db;
        }  

        /*
            Registro de um produto na base.
        */
        public function register( $product_array ){

            if( !is_array($product_array) || empty($product_array) ){
                $this -> _set_error('Campos vazios.');
                return;
            } 
            $nome            = $product_array['nome'] ?? null;
            $preco_unidade   = $product_array['preco_unidade'] ?? null; 
            $tipo_id         = $product_array['tipo_id'] ?? null; 

            /*
                Validaremos o tipo do produto
            */
            if( !is_int( $tipo_id ) && !ctype_digit($tipo_id) ){
                $this -> _set_error('Tipo de produto inválido!');
                return;
            }

            /*
                Validaremos o nome do produto
            */
            if( empty($nome) || !is_string($nome) || strlen( $nome ) > 50 ){
                $this -> _set_error('O nome do produto deve ter entre 1 e 50 caracteres!');
                return;
            } 

            /*
                Validaremos o preço do produto
            */
            if( ( !is_numeric($preco_unidade) && !ctype_digit($preco_unidade) ) ||  $preco_unidade < 0.01 ){
                $this -> _set_error('O preço unitário do produto deve ser maior que R\$ 0.00');
                return;
            }

            /*
                Vamos verificar se o TIPO existe
            */ 
            $productType = (new ProductTypeRepository( $this -> _db )) -> fetch_by_id( $tipo_id );
            if( !is_object($productType) ){
                $this -> _set_error('Tipo de produto não existe!');
                return;
            }

            $product = new ProductEntity();
            $product -> nome = htmlspecialchars($nome); //Evitaremos o HTML
            $product -> preco_unidade = $preco_unidade; 
            $product -> data_registro = date('Y-m-d H:i:s'); 
            $product -> tipo_id = $productType -> id;

            $repository = new ProductRepository( $this -> _db );

            return $repository -> register( $product ); 
        }

    }

?>