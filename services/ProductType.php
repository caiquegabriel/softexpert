<?php 

    namespace services; 

    use services\Service;

    use entities\ProductType as ProductTypeEntity;
    use repositories\ProductType as ProductTypeRepository;

    class ProductType extends Service{ 

        protected $_db;

        public function __construct( $db ){
            $this -> _db = $db;
        }  

        /*
            Registro de um produto na base.
        */
        public function register( $type_array ){

            if( !is_array($type_array) || empty($type_array) ){
                $this -> _set_error('Campos vazios.');
                return;
            }
 
            $percentual_imposto  = $type_array['percentual_imposto'] ?? null; 
            $nome  = $type_array['nome'] ?? null; 
            $cod  = $type_array['cod'] ?? null; 

            /*
                Validaremos o nome 
            */
            if( empty($nome) || !is_string($nome) || strlen( $nome ) > 50 ){
                $this -> _set_error('O nome do tipo deve ter entre 1 e 50 caracteres!');
                return;
            } 

            /*
                Validaremos o cod
            */
            if( !is_string($cod) || strlen( $cod ) > 10 ){
                $this -> _set_error('O código do tipo deve ter entre 1 e 10 caracteres!');
                return;
            } 
 
            /*
                Validaremos o percentual de imposto
            */
            if( ( !is_numeric($percentual_imposto) && !ctype_digit($percentual_imposto) ) ||  $percentual_imposto < 0.00 ){
                $this -> _set_error('O  percentual de imposto deve ser maior que -0.01');
                return;
            }

            /*
                Vamos checar se o código já existe.
            */ 
            $productType = (new ProductTypeRepository( $this -> _db )) -> fetch_by_cod( $cod );
            if(  is_object($productType) ){
                $this -> _set_error('Código do tipo já existente. Cadastre um diferente.');
                return;
            }
 
            $type = new ProductTypeEntity(); 
            $type -> percentual_imposto = $percentual_imposto; 
            $type -> data_registro = date('Y-m-d H:i:s'); 
            $type -> nome = htmlspecialchars($nome);
            $type -> cod = htmlspecialchars($cod);
             
            $repository = new ProductTypeRepository( $this -> _db ); 
            return $repository -> register( $type ); 
        }

    }

?>