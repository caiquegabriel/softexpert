<?php 

    namespace entities;

    use entities\Entity;

    class Product extends Entity{ 

        protected $id; 

        protected $nome; 

        protected $tipo_id;

        protected $data_registro;

        protected $data_update;

        protected $preco_unidade; 

        protected $produto_percentual_imposto; 

        protected $produto_tipo_nome;


        public function set_id( $id ){
            if( !is_int($id) && !ctype_digit($id))
                return;
            $this -> id = $id;
        }

        public function set_nome( $nome ){
            if( !is_string($nome) || strlen($nome) > 50 )
                return;
            $this -> nome = $nome;
        }

        public function set_produto_tipo_nome( $produto_tipo_nome ){ 
            $this -> produto_tipo_nome = $produto_tipo_nome;
        }

        public function set_produto_percentual_imposto( $produto_percentual_imposto ){ 
            $this -> produto_percentual_imposto = $produto_percentual_imposto;
        }

        public function set_tipo_id( $tipo_id ){ 
            if( !is_int($tipo_id) && !ctype_digit($tipo_id))
                return;
            $this -> tipo_id = $tipo_id; 
        }

        public function set_data_update( $data_update ){
            $this -> data_update = $data_update;
        }

        public function set_preco_unidade( $preco_unidade ){
            if( !is_numeric($preco_unidade))
                return;
            $this -> preco_unidade = $preco_unidade;
        }

        public function set_data_registro( $data_registro ){
            $this -> data_registro = $data_registro;
        }

    }

?>