$(document).ready(function() {  
});

function buscarParcelas(){
    nomeCliente = $("#nomeCliente").val();
    //se nome estiver vazio mostrar ao user
    if(!nomeCliente == ''){
        //Fazer consulta
        //Requisição AJAX GET retornando parcelas em aberto do plano seleciondo
        $.get("/clients/buscarParcelasAberto/"+nomeCliente, function(data){
            $("#parcelasCliente").html('');
            obj = JSON.parse(data);
            if(obj.length  == 0){
                $("#parcelasCliente").html('Sem resultados para a pesquisa');   
            }else{
                $("#parcelasCliente").html(''); 
                $.each(obj, function(i,item){
                    $.each(obj[i], function(i2,item2){
                        $("#parcelasCliente").append('<input type="checkbox" class="parcela" name="parcela[]" id="'+obj[i][i2].id+'" value="'+obj[i][i2].id+'">'+ 'Cod ' + obj[i][i2].id + ' R$ ' + '<label for="'+obj[i][i2].id+'">'+obj[i][i2].value + '</label>'+ ' Responsável ' + obj[i][i2].nome_cliente + '<br>');
                        $("#parcelasCliente").append('<input type="hidden" name="cliente_id" value="'+obj[i][i2].cliente_id+'">');
                    });
                }); 
            }
            //Chamar aqui o evento de calcular o total das parcelas
            calcularValorTotal(0);                    
        });
    }else{
        alert('Pesquisa Vazia');
        return false;
    }
}
//limpar campo de pesquisa do nome do cliente
function limparCampos(){
    $("#nomeCliente").val('');            
    $("#parcelasCliente").html('');            
}

function calcularValorTotal(valor){
    total = valor;
    $(".parcela").change(function(){
        if($(this).prop("checked") == true){
            console.log(this);
            $("#total").html('');                    
            label = $(this).prop("labels");
            text = $(label).text();
            console.log(text);                    
            valor = parseFloat(text);                    
            total = total + valor;
            
            $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
            $("#total").append('R$');   
            $("#total").append(total.toFixed(2));
                              
        }else{
            $("#total").html('');                    
            label = $(this).prop("labels");
            text = $(label).text();
            console.log(text);                    

            valor = parseFloat(text);
            total = total - valor;
            $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
            $("#total").append('R$');   
            $("#total").append(total.toFixed(2)); 
            console.log(total);

        }
    });
}