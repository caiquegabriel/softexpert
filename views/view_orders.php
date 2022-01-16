<?php  
    if( !defined('START') ) die('...');

    foreach( $orders as $order ){
        echo"
        <div>  
            <p>Venda #{$order['id']}</p>
            <p>{$order['data_registro']}</p>
            <p>Contém <strong>{$order['items_count']}</strong> itens</p>
            <div> 
                <a href='index.php?teste=true&a=view_order&id={$order['id']}'>Ver detalhes</a>
            </div>
        </div>";
    }

?>