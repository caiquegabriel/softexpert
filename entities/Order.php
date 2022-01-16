<?php 

    namespace entities;

    use entities\Entity;

    class Order extends Entity{ 

        protected $id;  

        protected $data_registro; 


        public function set_id( $id ){
            if( !is_int($id) && !ctype_digit($id))
                return;
            $this -> id = $id;
        }

        public function set_data_registro( $data_registro ){
            $this -> data_registro = $data_registro;
        }

    }

?>