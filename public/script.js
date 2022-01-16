$(function(){
    $('[produtos]').each(function(){
        let $produtos = $(this); 
        $(document).on('click', '[add]', function(){
            $produtos.append($(this).parents('[produto]').clone());
        });  
    });   

});