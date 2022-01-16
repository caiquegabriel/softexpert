<?php  
    if( !defined('START') ) die('...'); 
?>


<div> 

    <div> 
        <h1><p>Venda #<?= $order['id'] ?></p></h1>
        <ul> 
            <li><?= count($order['items']) ?> produtos </li>
            <li><?= $order['count_all_items']  ?> itens </li>
            <li>R$ <?= mask_price($order['preco_total']) ?> </li>
        </ul>
    </div>
   

    <h3> Itens </h3> 
    <div class="struct-items-container">
        <?php foreach( $order['items'] as $item ): ?> 
            <div class="struct-item">  
                <p>( <?= $item['quantidade'] ?>x ) <?= $item['produto_nome'] ?></p> 
                <p>Preço unitário: R$ <?= mask_price( $item['produto_preco'] ) ?> </p> 
                <p>Preço dos (<?= $item['quantidade'] ?>) itens: R$  <?= mask_price( $item['preco_itens'] ) ?> </p>  
                <p>Imposto:  R$  <?= mask_price( $item['preco_imposto'] ) ?> <i>( <?=  mask_price( $item['produto_percentual_imposto'] ) ?> %)</i></p> 
                <p>Preço com imposto:  R$  <?= mask_price( $item['preco_total'] ) ?></p> 
            </div>
        <?php endforeach; ?>
    </div>

</div>