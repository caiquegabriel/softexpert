<?php  
    if( !defined('START') ) die('...'); 
?>


<div> 

    <p>Venda #<?= $order['id'] ?></p>

    <h3> Itens </h3> 

    <?php foreach( $order['items'] as $item ): ?> 
        <div>  
            <p>( <?= $item['quantidade'] ?>x ) <?= $item['produto_nome'] ?></p> 
            <p>Preço unitário: R$ <?= mask_price( $item['produto_preco'] ) ?> </p> 
            <p>Preço total dos itens: R$  <?= mask_price( $item['preco_itens'] ) ?> </p>  
            <p>Preço do imposto:  R$  <?= mask_price( $item['preco_imposto'] ) ?> <i>( <?=  mask_price( $item['produto_percentual_imposto'] ) ?> %)</i></p> 
            <p>Preço total:  R$  <?= mask_price( $item['preco_total'] ) ?> (%)</p> 
        </div>
    <?php endforeach; ?>

</div>