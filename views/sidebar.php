<?php  if( !defined('START') ) die('...');  ?>

<div class="page-sidebar">
    <div class="sidebar-header">
        <a class="logo" href="#">
            <img src="" alt="Logo" />
        </a><!--.logo-->
    </div><!--.sidebar-header-->

    <div class="sidebar-body">
        <ul class="sidebar-menu menu">
            <li class="category"></li>
            <li>
                <a href="index.php?teste=true&a=view_orders" <?= isset($global_orders_count) ? 'data-count="'.$global_orders_count.'"' : null ?> ><i class="icon-prepend fas fa-shopping-cart"></i>Vendas</a>
            </li> 
            <li>
                <a href="index.php?teste=true&a=view_orders" <?= isset($global_products_count) ? 'data-count="'.$global_products_count.'"' : null ?> ><i class="icon-prepend fas fa-shopping-cart"></i>Produtos</a>
            </li>
            <li>
                <a href="index.php?teste=true&a=view_orders" <?= isset($global_product_types_count) ? 'data-count="'.$global_product_types_count.'"' : null ?> ><i class="icon-prepend fas fa-shopping-cart"></i>Tipos de produtos</a>
            </li>
        </ul><!--.sidebar-menu-->
    </div><!--.sidebar-body-->

</div><!--.page-sidebar-->