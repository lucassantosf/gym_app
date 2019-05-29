$(function(){
    $("#txtBusca").focus(); 
    $("#txtBusca").keyup(function(){
        var texto = $(this).val();
        $("#list1,.component_pag").hide();
        $("#cardBody").hide();
        $("#list2").show();
        if (texto.length == 0) {
            $("#list1,.component_pag").show(); 
            $("#cardBody").show(); 
            $("#list2").hide(); 
        }
        $(".ulItens li").show();
        $(".ulItens li").each(function(){
            if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) $(this).hide(); 
        });
    });
});    