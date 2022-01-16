$(function(){
    $('[produtos]').each(function(){
        let $produtos = $(this); 
        $(document).on('click', '[add]', function(){
            $produtos.append($(this).parents('[produto]').clone());
        });  
    });  

    $(document).find('[produtos] select').change(function(){
        $(document).find('[produtos] select option:selected').each(function(){
            alert("sim");
        });
    });





});