<?php  if(!defined('START')) die() ?>
<!DOCTYPE html>
<html>

    <head>
        <title>Farmácia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    
    <link rel='stylesheet' id='fontAwesome-style-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css?ver=2.1.3' type='text/css' media='' />
    <link rel='stylesheet' id='fontAwesome-style-2-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css?ver=2.1.3' type='text/css' media='' />    
    <link rel="stylesheet" href="../public/style.css" /> 
   

    <body>
        <div class="page"> 
 
            <div class="page-body">



                <div class="page-wrapper">

                    <!-- SIDEBAR -->
                    <?php require_once('sidebar.php'); ?>
                     

                     
                    <div class="page-content">
                        <div class="page-container"> 
                            <div class="header clearfix">
                                <p class="title fs-22">Venda #<?= $order['id'] ?></p>
                                <ul class="menu"> 
                                    <li><i class="fas fa-box"></i><?= count($order['items']) ?> produtos </li>
                                    <li><i class="fas fa-boxes"></i><?= $order['count_all_items']  ?> itens </li>
                                    <li><strong>R$</strong> <?= mask_price($order['preco_itens']) ?> </i>( aprox. sem impostos )</i></li>
                                    <li><strong>R$</strong> <?= mask_price($order['preco_total']) ?> </i>( aprox. com impostos )</i></li>
                                </ul>
                            </div><!--.page-main-->

                            <div class="main">
                                <h3>Detalhes dos produtos adquiridos</h3> 
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
                            </div><!--.page-main-->

                        </div><!--.page-container-->
                    </div><!--.page-content-->
                     

                </div><!--.page-wrapper-->

            </div><!--.page-body-->
        </div><!--.page-->
    </body>  
</html>