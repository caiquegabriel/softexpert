<?php  if(!defined('START')) die() ?>
<!DOCTYPE html>
<html>

    <head>
        <title>Vendas</title>
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
                                <p class="title fs-22">Vendas</p> 
                            </div><!--.page-main-->

                            <div class="main">
                                <p></p> 

                                <div class="cards"> 
                                    <div class="card">
                                        <div class="card-header"> 
                                            <p class="fs-16" style="color: var(--page-subtitle-color)">Quantidade de vendas</p>
                                        </div><!--.card-header--> 
                                        <div class="card-body"> 
                                            <p class="fs-30"><?= count($orders) ?> </p>
                                        </div><!--.card-body-->
                                    </div><!--.card-->  
                                </div><!--.cards -->


                                <div class="mds-box mg-top-30"> 
                                    <h3>Lista de Vendas</h3>
                                    
                                    <table>
                                        <tr>
                                            <th>Nº da venda</th>
                                            <th>Data</th>
                                            <th>Quantidade de itens</th> 
                                            <th></th> 
                                        </tr>
                                        <?php foreach( $orders as $order ): ?> 
                                            <tr>
                                                <td>Venda #<?= $order['id'] ?></td>
                                                <td><?= date_format( date_create($order['data_registro']), 'd/m/Y H:i:s' ) ?></td>
                                                <td><?= $order['items_count'] ?></td> 
                                                <td><a href="index.php?a=view_order&id=<?= $order['id'] ?>" class="btn btn-secondary" ><i class="icon-prepend far fa-eye"></i>Detalhes</a></td> 
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