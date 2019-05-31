$(document).ready(function() { 
    //Desmarcar todos checkbox - pois no rollback da pagina ficaria marcado
    $('.parcela').prop("checked", false);
    calcularValorTotal(0);
});

function calcularValorTotal(valor){
    total = valor;
    $(".parcela").change(function(){
        if($(this).prop("checked") == true){
            $("#total").html('');                    
            label = $(this).prop("labels");
            text = $(label).text();
            valor = parseFloat(text);
            total = total + valor;
            $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
            $("#total").append('R$');   
            $("#total").append(total.toFixed(2));   
                              
        }else{
            $("#total").html('');                    
            label = $(this).prop("labels");
            text = $(label).text();
            valor = parseFloat(text);
            total = total - valor;
            $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
            $("#total").append('R$');   
            $("#total").append(total.toFixed(2)); 
        }
    });
}