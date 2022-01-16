<?php 

    if( !defined('START') ) die('...');



    use repositories\Order as OrderRepository;  
    use repositories\Product as ProductRepository;  
    use repositories\ProductType as ProductTypeRepository;  
    use services\Order as OrderService;  
    use services\Product as ProductService;  
    use services\ProductType as ProductTypeService;  

    $action = $_GET['a'] ?? '';

    $global_orders_count = ( new OrderRepository( db() ) ) -> count_all();
    $global_products_count = ( new ProductRepository( db() ) ) -> count_all();
    $global_product_types_count = ( new ProductTypeRepository( db() ) ) -> count_all();


    switch( $action ){
        case 'register_order':
            $pService = new OrderService( db() );
            $results = $pService -> register(  
                [  
                    [ 
                        'produto_id' => 16, 
                        'quantidade' => 10 
                    ], 
                    [ 
                        'produto_id' => 16, 
                        'quantidade' => 25
                    ], 
                    [ 
                        'produto_id' => 12, 
                        'quantidade' => 25
                    ], 
                    [ 
                        'produto_id' => 14, 
                        'quantidade' => 15
                    ]
                ]
            );

            if( $results ){
                echo ">>". $results;
            }else{
                var_dump( $pService -> get_errors() );
            }
        break;
        case 'register_order_form':
            
            $ProductService = new ProductService( db() );
            $products = $ProductService -> fetch_products(); 

            require_once('views/view_register_order_form.php');
        break;
        case 'register_type':
            $pService = new ProductTypeService( db() );
            $results = $pService -> register(  
                [  
                    'percentual_imposto' => 1.90,
                    'nome' => "Legumes",
                    'cod' => "LEGUMES029",
                ]
            );

            if( $results ){
                echo ">>". $results;
            }else{
                var_dump( $pService -> get_errors() );
            }
        break;
        case 'register_product':
            $pService = new ProductService( db() );
            $results = $pService -> register(  
                [ 
                    'nome'          => 'Batata', 
                    'preco_unidade' => 4.56,
                    'tipo_id'      => 12,
                ]
            );
        
            if( $results ){
                echo ">>". $results;
            }else{
                var_dump( $pService -> get_errors() );
            }
        break;
        case 'view_products':
            $ProductService = new ProductService( db() );
            $products = $ProductService -> fetch_products(); 
 
            require_once('views/view_products.php');
        break;
        case 'view_product_types':
            $ProductTypeService = new ProductTypeService( db() );
            $types = $ProductTypeService -> fetch_types(); 
 
            require_once('views/view_product_types.php');
        break;
        case 'view_orders':
            $OrderService = new OrderService( db() );
            $orders = $OrderService -> fetch_orders(); 
            

            require_once('views/view_orders.php');
        break;
        case 'view_order':

            $order_id = $_GET['id'] ?? null;  
            $OrderService = new OrderService( db() );
            $order = $OrderService -> fetch_order_by_id( $order_id );
            
            if( !is_array($order) ) {
                require_once('views/error.php');
                return;
            }

            require_once('views/view_order.php');
        break;
    }
 
     


 
    

?>