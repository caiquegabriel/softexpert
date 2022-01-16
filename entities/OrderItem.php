<?php 

    namespace entities;

    use entities\Entity;

    class OrderItem extends Entity{ 

        protected $id;  

        protected $produto_id; 

        protected $venda_id;  

        protected $quantidade; 

        protected $produto_preco; 

        protected $produto_percentual_imposto; 



        public function set_id( $id ){
            if( !is_int($id) && !ctype_digit($id))
                return;
            $this -> id = $id;
        }

        public function set_produto_id( $produto_id ){
            if( !is_int($produto_id) && !ctype_digit($produto_id))
                return;
            $this -> produto_id = $produto_id;
        }

        public function set_venda_id( $venda_id ){
            if( !is_int($venda_id) && !ctype_digit($venda_id))
                return;
            $this -> venda_id = $venda_id;
        }

        public function set_quantidade( $quantidade ){
            if( !is_int($quantidade) && !ctype_digit($quantidade))
                return;
            $this -> quantidade = $quantidade;
        }

        public function set_produto_preco( $produto_preco ){
            if( !is_numeric($produto_preco) )
                return;
            $this -> produto_preco = $produto_preco;
        }

        public function set_produto_percentual_imposto( $produto_percentual_imposto ){
            if( !is_numeric($produto_percentual_imposto))
                return;
            $this -> produto_percentual_imposto = $produto_percentual_imposto;
        }

        public function get_valor_total( ){
            return $this -> quantidade * $this -> produto_preco;
        }

    }

?>