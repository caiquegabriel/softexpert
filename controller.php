<?php 

    if( !defined('START') ) die('...');



    use repositories\Product as ProductRepo; 
    use entities\Product as ProductEntity; 


    $product = new entities\Product();

    $product -> nome = "Acai"; 
    $product -> preco_unidade = 20.23;
     
    $repository = new ProductRepo( db() );
    $repository -> register( $product );

?>