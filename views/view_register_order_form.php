<?php  if(!defined('START')) die() ?>
<!DOCTYPE html>
<html>

    <head>
        <title>Nova venda</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel='stylesheet' id='fontAwesome-style-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css?ver=2.1.3' type='text/css' media='' />
        <link rel='stylesheet' id='fontAwesome-style-2-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css?ver=2.1.3' type='text/css' media='' />    
        <link rel="stylesheet" href="../public/style.css" /> 
    
         
        <script src="../public/jquery.js" ></script> 
        <script src="../public/jquery_masks.js" ></script> 
        <script src="../public/script.js"></script>
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
                                <p class="title fs-22">Nova venda</p> 
                            </div><!--.page-main-->

                            <div class="main">

                                <form action="index.php?teste=true&a=register_order" method="POST"> 

                                    <div produtos> 
                                        <div produto class="row"> 
                                            <div class="col-7"> 
                                                <select name="produto_id[]">
                                                    <?php foreach( $products as $product ): ?>
                                                        <option value="<?= $product['id'] ?>" percentual="<?= $product['produto_percentual_imposto'] ?>" valor="<?= $product['preco_unidade'] ?>" ><?= $product['nome'] ?> ( <?= mask_price( $product['preco_unidade'] , true) ?> + <?= mask_price( $product['produto_percentual_imposto'] ) ?>% ) </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-4"> 
                                                <input name="quantidade[]" />
                                            </div> 
                                            <div class="col-1"> 
                                                <a href="#" add>Adicionar mais</a> 
                                            </div> 
                                        </div>  
                                    </div> 

                                    <div> 
                                        <button type="submit" class="btn btn-primary">Efetuar venda</button>
                                    </div>

                                </form>
                                
                            </div><!--.main-->

                        </div><!--.page-container-->
                    </div><!--.page-content-->
                     

                </div><!--.page-wrapper-->

            </div><!--.page-body-->
        </div><!--.page-->
    </body>  
</html>