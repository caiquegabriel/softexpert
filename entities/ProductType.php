<?php 

    namespace entities;

    use entities\Entity;

    class ProductType extends Entity{ 

        protected $id; 

        protected $nome; 

        protected $codigo; 

        protected $data_registro;

        protected $data_update; 

        protected $percentual_imposto; 

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

        public function set_cod( $cod ){
            if( is_string($cod) && strlen($cod) < 10 )
                return;
            $this -> cod = $cod;
        } 

        public function set_data_update( $data_update ){
            $this -> data_update = $data_update;
        }

        public function set_percentual_imposto( $percentual_imposto ){
            if( !is_numeric($percentual_imposto))
                return;
            $this -> percentual_imposto = $percentual_imposto;
        }

        public function set_data_registro( $data_registro ){
            $this -> data_registro = $data_registro;
        }

    }

?>