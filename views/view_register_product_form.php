<?php  if(!defined('START')) die() ?>
<!DOCTYPE html>
<html>

    <head>
        <title>Nova Produto</title>
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
                                <p class="title fs-22">Novo Produto</p> 
                            </div><!--.page-main-->

                            <div class="main">


                                <form action="index.php?teste=true&a=register_product" class="mds-box" method="POST"> 
                                    <?php if( isset($_GET['error']) && is_string($_GET['error']) ): ?>
                                        <div class="message message-warning mg-bottom-20"><?= urldecode($_GET['error']) ?></div><!--.message-->
                                    <?php endif; ?>
                                    
                                    <div class="row"> 
                                        <div class="col-4"> 
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" placeholder="Ex.: NOME" />
                                        </div>

                                        <div class="col-4"> 
                                            <label for="tipo_id">Tipo</label>
                                            <select name="tipo_id"> 
                                                <?php foreach( $types as $type ): ?> 
                                                    <option value="<?= $type['id'] ?>"><?= $type['nome'] ?>(<?= $type['cod'] ?>) | Imposto : <?= mask_price($type['percentual_imposto']) ?> % <option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-4"> 
                                            <label for="preco_unidade">Preço da unidade</label>
                                            <input type="text" name="preco_unidade" placeholder="Ex.: 0.00" />
                                        </div>
                                    </div>

                                    <div class="form-submit"> 
                                        <button type="submit" class="btn btn-primary"><i class="icon-prepend fas fa-paper-plane"></i>Cadastrar</button>
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