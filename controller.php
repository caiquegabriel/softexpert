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
        //OK
        case 'register_order':
            $pService = new OrderService( db() );

            $produtos = [];

            for( $i = 0; $i < count( ($_POST['produto_id'] ?? []) ); $i++){
                $produto_id = $_POST['produto_id'][$i] ?? 0 ;
                $quantidade = $_POST['quantidade'][$i] ?? 0 ;

                $produtos[] = [ 'produto_id' => $produto_id, 'quantidade' => $quantidade ];
            } 
            $results = $pService -> register($produtos);

            if( $results ){ 
                header( 'Location: index.php?a=view_order&id='.$results );
            }else{
                $error = urlencode( $pService -> get_errors()[0] ?? "" );
                header( 'Location: index.php?a=register_order_form&error='.$error );
            }
        break; 
        //OK
        case 'register_order_form':

            $ProductService = new ProductService( db() );
            $products = $ProductService -> fetch_products(); 

            require_once('views/view_register_order_form.php');
        break;
        //OK
        case 'register_product_form':  

            $ProductTypeService = new ProductTypeService( db() );
            $types = $ProductTypeService -> fetch_types(); 

            require_once('views/view_register_product_form.php');
        break;
        //OK
        case 'register_product_type_form':   
            require_once('views/view_register_product_type_form.php');
        break;
        //OK
        case 'register_product_type':
            $pService = new ProductTypeService( db() );
            $results = $pService -> register($_POST);

            if( $results ){ 
                header( 'Location: index.php?a=view_product_types' );
            }else{
                $error = urlencode( $pService -> get_errors()[0] ?? "" );
                header( 'Location: index.php?a=register_product_type_form&error='.$error );
            }
        break;
        //OK
        case 'register_product':
            $pService = new ProductService( db() );
            $results = $pService -> register($_POST);
            
            if( $results ){ 
                header( 'Location: index.php?a=view_products' );
            }else{
                $error = urlencode( $pService -> get_errors()[0] ?? "" );
                header( 'Location: index.php?a=register_product_form&error='.$error );
            }
        break;
        //OK
        case 'view_products':
            $ProductService = new ProductService( db() );
            $products = $ProductService -> fetch_products(); 
 
            require_once('views/view_products.php');
        break;
        //OK
        case 'view_product_types':
            $ProductTypeService = new ProductTypeService( db() );
            $types = $ProductTypeService -> fetch_types(); 
 
            require_once('views/view_product_types.php');
        break;
        //OK
        case 'view_orders':
            $OrderService = new OrderService( db() );
            $orders = $OrderService -> fetch_orders(); 
            

            require_once('views/view_orders.php');
        break;
        //OK
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
        default:  

            $OrderService = new OrderService( db() );
            $orders = $OrderService -> fetch_orders(); 
            

            require_once('views/view_orders.php');
        break;
    }
 
     


 
    

?>