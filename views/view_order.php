<?php  if(!defined('START')) die() ?>
<!DOCTYPE html>
<html>

    <head>
        <title>Venda #<?= $order['id'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel='stylesheet' id='fontAwesome-style-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css?ver=2.1.3' type='text/css' media='' />
        <link rel='stylesheet' id='fontAwesome-style-2-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css?ver=2.1.3' type='text/css' media='' />    
        <link rel="stylesheet" href="<?= ROOT ?>/public/style.css" /> 
    
        <script src="<?= ROOT ?>/public/script.js"></script>
        <script src="<?= ROOT ?>/public/jquery.js" ></script> 
        <script src="<?= ROOT ?>/public/jquery_masks.js" ></script> 
    </head>
    
     
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
                                    <li><strong>Venda realizada em</strong> <?= date_format( date_create($order['data_registro']), 'd/m/Y H:i:s' ) ?></li>
                                </ul>
                            </div><!--.page-main-->

                            <div class="main">
                                <p></p>  
                                <div class="cards"> 
                                    <div class="card">
                                        <div class="card-header"> 
                                            <p class="fs-16" style="color: var(--page-subtitle-color)">Quantidade de produtos</p>
                                        </div><!--.card-header--> 
                                        <div class="card-body"> 
                                            <p class="fs-30"><?= count($order['items']) ?> </p>
                                        </div><!--.card-body-->
                                    </div><!--.card-->
                                    <div class="card">
                                        <div class="card-header"> 
                                            <p class="fs-16" style="color: var(--page-subtitle-color)">Quantidade de itens</p>
                                        </div><!--.card-header--> 
                                        <div class="card-body"> 
                                            <p class="fs-30"><?=  $order['count_all_items'] ?> </p>
                                        </div><!--.card-body-->
                                    </div><!--.card-->
                                    <div class="card">
                                        <div class="card-header"> 
                                            <p class="fs-16" style="color: var(--page-subtitle-color)">Valor Total (SEM IMPOSTO)</p>
                                        </div><!--.card-header--> 
                                        <div class="card-body"> 
                                            <p class="fs-30"><?=  mask_price($order['preco_itens'], true) ?> </p>
                                        </div><!--.card-body-->
                                    </div><!--.card-->
                                    <div class="card">
                                        <div class="card-header"> 
                                            <p class="fs-16" style="color: var(--page-subtitle-color)">Valor Total (COM IMPOSTO)</p>
                                        </div><!--.card-header--> 
                                        <div class="card-body"> 
                                            <p class="fs-30"><?= mask_price($order['preco_total'], true) ?> </p>
                                        </div><!--.card-body-->
                                    </div><!--.card-->
                                </div><!--.cards -->


                                <div class="mds-box mg-top-30"> 
                                    <h3>Lista de pedidos</h3>
                                    
                                    <table>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Preço Unitário</th>
                                            <th>Quantidade</th>
                                            <th>Preço Total</th>
                                            <th>% Imposto</th>
                                            <th>Preço do Imposto</th>
                                            <th>Preço Total</th>
                                        </tr>
                                        <?php foreach( $order['items'] as $item ): ?> 
                                            <tr>
                                                <td><?= $item['produto_nome'] ?></td>
                                                <td><?= mask_price( $item['produto_preco'], true ) ?></td>
                                                <td><?= $item['quantidade'] ?></td>
                                                <td><?= mask_price( $item['preco_itens'], true ) ?></td>
                                                <td><?= mask_price( $item['produto_percentual_imposto'] ) ?> %</td>
                                                <td><?= mask_price( $item['preco_imposto'], true ) ?></td>
                                                <td><?= mask_price( $item['preco_total'], true ) ?></td> 
                                            </tr>  
                                        <?php endforeach; ?> 
                                    </table> 
                                </div><!--.mds-box-->
                                 
                            </div><!--.page-main-->

                        </div><!--.page-container-->
                    </div><!--.page-content-->
                     

                </div><!--.page-wrapper-->

            </div><!--.page-body-->
        </div><!--.page-->
    </body>  
</html>