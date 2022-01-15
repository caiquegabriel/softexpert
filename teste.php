<?php 

    if( !defined('START') ) die('...');



    use services\Product as ProductSerice;  
 
     
    $pService = new ProductSerice( db() );
    $results = $pService -> register(  
        [ 
            'nome'          => 'Uva Passa', 
            'preco_unidade' => 2.25
        ]
    );

    if( $results ){

    }else{
        var_dump( $pService -> get_errors() );
    }

?>