<?php 

    if( !defined('START') ) die('...');



    use services\Product as ProductSerice;  
 
     
    $repository = new ProductSerice( db() );
    $repository -> register(  
        [ 
            'nome' => 'Uva Passa', 
            'preco' => 2.25
        ]
    );

?>