<?php  if(!defined('START')) die() ?>
<!DOCTYPE html>
<html>

    <head>
        <title>Produtos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel='stylesheet' id='fontAwesome-style-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css?ver=2.1.3' type='text/css' media='' />
        <link rel='stylesheet' id='fontAwesome-style-2-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css?ver=2.1.3' type='text/css' media='' />    
        <link rel="stylesheet" href="../public/style.css" /> 
    
        <script src="../public/script.js"></script>
        <script src="../public/jquery.js" ></script> 
        <script src="../public/jquery_masks.js" ></script> 
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
                                <p class="title fs-22">Produtos</p> 
                            </div><!--.page-main-->

                            <div class="main">
                                <p></p> 

                                <div class="cards"> 
                                    <div class="card">
                                        <div class="card-header"> 
                                            <p class="fs-16" style="color: var(--page-subtitle-color)">Produtos</p>
                                        </div><!--.card-header--> 
                                        <div class="card-body"> 
                                            <p class="fs-30"><?= count($products) ?> </p>
                                        </div><!--.card-body-->
                                    </div><!--.card-->  
                                </div><!--.cards -->


                                <div class="mds-box mg-top-30"> 
                                    <h3>Lista de Produtos</h3>
                                    
                                    <table>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Data registro</th> 
                                            <th>Preço Unidade</th>   
                                        </tr>
                                        <?php foreach( $products as $product ): ?> 
                                            <tr>
                                                <td><?= $product['id'] ?></td>
                                                <td><?= $product['nome'] ?></td>
                                                <td><?= $product['produto_tipo_nome'] ?></td>
                                                <td><?= date_format( date_create($product['data_registro']), 'd/m/Y H:i:s' ) ?></td>
                                                <td><?= mask_price( $product['preco_unidade'], true) ?></td> 
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