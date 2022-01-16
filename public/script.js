$(function(){
    $('[produtos]').each(function(){
        let $produtos = $(this); 
        $(document).on('click', '[add]', function(){
            $produtos.append($(this).parents('[produto]').clone());
        });  
    });   


    $(document).on("keypress", "[name=percentual_imposto]", function (e) {
		$(this).mask('##.##', {reverse: true});
	});

    $(document).on("keypress", "[name=preco_unidade]", function (e) {
		$(this).mask('#####.##', {reverse: true});
	});

});