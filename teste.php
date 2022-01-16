<?php 

    if( !defined('START') ) die('...');



    use services\Order as OrderService;  
    use services\Product as ProductService;  
    use services\ProductType as ProductTypeService;  

    $action = $_GET['a'] ?? '';


    switch( $action ){
        case 'register_order':
            $pService = new OrderService( db() );
            $results = $pService -> register(  
                [  
                    [ 
                        'produto_id' => 13, 
                        'quantidade' => 10 
                    ], 
                    [ 
                        'produto_id' => 13, 
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
                    'nome'          => 'Uva Passa', 
                    'preco_unidade' => 4.56,
                    'tipo_id'      => 4,
                ]
            );
        
            if( $results ){
                echo ">>". $results;
            }else{
                var_dump( $pService -> get_errors() );
            }
        break;
        case 'view_orders':
            $OrderService = new OrderService( db() );
            $orders = $OrderService -> fetch_orders();

            extract( $orders );

            require_once('views/view_orders.php');
        break;
        case 'view_order':

            $order_id = $_GET['id'] ?? null;  
            $OrderService = new OrderService( db() );
            $order = $OrderService -> fetch_order_by_id( $order_id );

          //  extract( $orders );

          //  require_once('views/view_orders.php');
        break;
    }
 
     


 
    

?>