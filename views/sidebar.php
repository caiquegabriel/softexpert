<?php  if( !defined('START') ) die('...');  ?>

<div class="page-sidebar">
    <div class="sidebar-header">
        <a class="logo" href="#">
            <img src="" alt="Logo" />
        </a><!--.logo-->
    </div><!--.sidebar-header-->

    <div class="sidebar-body">
        <ul class="sidebar-menu menu">
            <li class="category">Vendas</li>
            <li>
                <a href="index.php?a=view_orders" <?= isset($global_orders_count) ? 'data-count="'.$global_orders_count.'"' : null ?> ><i class="icon-prepend fas fa-shopping-cart"></i>Vendas</a>
            </li> 
            <li>
                <a href="index.php?a=register_order_form" ><i class="icon-prepend fas fa-cart-plus"></i>Nova venda</a>
            </li> 
        </ul><!--.sidebar-menu-->


        <ul class="sidebar-menu menu">
            <li class="category">Produtos</li> 
            <li>
                <a href="index.php?a=view_products" <?= isset($global_products_count) ? 'data-count="'.$global_products_count.'"' : null ?> ><i class="icon-prepend fas fa-boxes"></i>Produtos</a>
            </li>
            <li>
                <a href="index.php?a=view_product_types" <?= isset($global_products_count) ? 'data-count="'.$global_product_types_count.'"' : null ?> ><i class="icon-prepend fas fa-tags"></i>Tipos</a>
            </li>
            <li>
                <a href="index.php?a=register_product_form" ><i class="icon-prepend far fa-plus-square"></i>Novo produto</a>
            </li>
            <li>
                <a href="index.php?a=register_product_type_form" ><i class="icon-prepend far fa-plus-square"></i>Novo tipo</a>
            </li>
        </ul><!--.sidebar-menu-->
    </div><!--.sidebar-body-->

</div><!--.page-sidebar-->