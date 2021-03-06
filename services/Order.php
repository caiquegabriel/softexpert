<?php 

    namespace services; 

    use services\Service;

    use entities\Order as ProductEntity;
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
            Retorna as ordens/vendas efetuadas e o número de itens. 
            @Return (array) $orders
        */
        public function fetch_orders(){ 

            $orderRepository       =  new OrderRepository($this -> _db);
            $orderItemRepository   =  new orderItemRepository($this -> _db);
            $orders = $orderRepository -> fetch_all();

            if( empty($orders) ) return [];

            foreach( $orders as &$order ){ 
                $order = $order -> get_vars();
                
                /*
                    Vamos pegar os itens da venda 
                */
                $order['items_count'] = $orderItemRepository -> count_items_by_order_id( $order['id'] ); 
            }
            return $orders;
        }

        /*
            Retorna a ordem e seus itens
            @Return (array) $orders
        */
        public function fetch_order_by_id( $order_id ){ 

            if( !ctype_digit( $order_id ) && !is_numeric($order_id)){
                $this -> _set_error('ID da ordem inválida!');
                return;
            }  

            $orderRepository       =  new OrderRepository($this -> _db);
            $orderItemRepository   =  new orderItemRepository($this -> _db);
            $order = $orderRepository -> fetch_by_id( $order_id );

            if( !is_object($order) ) return null;
            

            $order = $order -> get_vars();
            $order['preco_itens'] = 0;
            $order['preco_total'] = 0;
            $order['items'] = $orderItemRepository -> fetch_items_by_order_id( $order_id );
            $order['count_all_items'] = $orderItemRepository -> count_items_by_order_id( $order_id );

            foreach( $order['items'] as &$item ){
                $item = $item -> get_vars(); 
                $item['preco_itens']  = ( $item['quantidade'] * $item['produto_preco'] );
                $item['preco_imposto'] = $item['preco_itens'] * ( $item['produto_percentual_imposto']/100 );
                $item['preco_total'] = $item['preco_itens'] + $item['preco_imposto'];
                $order['preco_itens'] += $item['preco_itens'];
                $order['preco_total'] += $item['preco_total'];
            }

             
            return $order;
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

            $item_produto_preco = $product  -> preco_unidade; 
            $item_produto_percentual_imposto = $productType->percentual_imposto ?? null; 


            $OrderItemEntity = new OrderItemEntity();
            $OrderItemEntity -> venda_id = $order_id; 
            $OrderItemEntity -> produto_id = $item_produto_id; 
            $OrderItemEntity -> quantidade = $item_quantidade; 
            $OrderItemEntity -> produto_preco = $item_produto_preco; 
            $OrderItemEntity -> produto_percentual_imposto = $item_produto_percentual_imposto; 
             
            /*
                Vamos registrar o item da compra 
            */
            return ( new OrderItemRepository($this -> _db)) -> register( $OrderItemEntity );
        }

    }

?>