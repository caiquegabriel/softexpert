<?php 

    namespace services; 

    use services\Service;

    use entities\Order as orderEntity;
    use entities\OrderItem as OrderItemEntity;
    use repositories\OrderItem as OrderItemRepository; 
    use repositories\Order as OrderRepository; 
    use repositories\Product as ProductRepository; 
    use repositories\ProductType as ProductTypeRepository; 

    class Order extends Service{ 

        protected $_db;

        public function __construct( $db ){
            $this -> _db = $db;
        }  

        /*
            Registro de uma compra na base
            @Param (array) $items : Itens da compra.
        */
        public function register( $items ){

            if( !is_array($items) || empty($items) ){
                $this -> _set_error('Adicione mais itens!');
                return;
            }  

            $orderRepository =  new OrderRepository($this -> _db);

            /*
                Primeiro vamos cadastrar na table order
            */
            $orderEntity = new orderEntity();
            $orderEntity -> data_registro = date('Y-m-d H:i:s');
            $order_id = $orderRepository -> register( $orderEntity );
            if( !$order_id ){
                $this -> _set_error('Falha ao cadastrar a venda.');
            }else{
                /*
                    Deu certo cadastrar a venda. Vamos cadastrar os itens da venda.
                */
                $items_registered = 0;
                foreach( $items as $item ){

                    if( ($item_id = $this -> _register_item($order_id, $item) ) ){
                        $items_registered++;
                    }

                }

                /*
                    Não registramos nenhum item.. vamos apagar a  compra do registro...
                */
                if( $items_registered == 0 ){
                    $orderRepository -> delete_by_id( $order_id );
                    $this -> _set_error('Compra não efetuada. Nenhum item foi registrado.');
                    return false;
                }

                if( $items_registered != count($items) ){
                    $this -> _set_error('Alguns itens não foram registrados!');
                }

                return $order_id; 
            }

        }

        /*
            Registro de uma compra na base
            @Param (int)   $order_id : ID da compra
            @Param (array) $item : Array com os dados de determinado item
        */
        protected function _register_item( $order_id, $item ){

            $item_produto_id = $item['produto_id'] ?? null;
            $item_quantidade = $item['quantidade'] ?? null;

            /*
                Validaremos o tipo do produto
            */
            if( !is_int( $item_produto_id ) && !ctype_digit($item_produto_id) ){
                $this -> _set_error('Tipo de produto inválido!');
                return;
            }

            if( (!is_int( $item_quantidade ) && !ctype_digit($item_quantidade) ) || $item_quantidade < 1 || $item_quantidade > 99 ){
                $this -> _set_error('Quantidade deve ser entre 1 e 99!');
                return;
            }

            /*
                Vamos pegar os dados do produto 
            */
            $product = ( new ProductRepository($this -> _db)) -> fetch_by_id( $item_produto_id );
            if( !is_object($product) ){
                $this -> _set_error('Produto inválido!');
                return;
            }

            /*
                Vamos pegar os dados do tipo do produto 
            */
            $productType = ( new ProductTypeRepository($this -> _db)) -> fetch_by_id( $product->tipo_id );
            if( !is_object($productType) ){
                $this -> _set_error('Tipo de Produto inválido!');
                return;
            }

            $item_produto_preco = $product  -> preco; 
            $item_produto_percentual_imposto = $productType->percentual_imposto ?? null; 


            $OrderItemEntity = new OrderItemEntity();
            $OrderItemEntity -> venda_id = $order_id; 
            $OrderItemEntity -> produto_id = $item_produto_id; 
            $OrderItemEntity -> quantidade = $item_quantidade; 
            $OrderItemEntity -> produto_precp = $item_produto_preco; 
            $OrderItemEntity -> produto_percentual_imposto = $item_produto_percentual_imposto; 
            
            /*
                Vamos registrar o item da compra 
            */
            return ( new OrderItemRepository($this -> _db)) -> register( $OrderItemEntity );
        }

    }

?>