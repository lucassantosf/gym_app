let toggleDesconto = true;
let toggleCond = true;
let desconto_valor = 0; 
$(document).ready(function() {    
    $("#add_desconto").click(function(e){
        if(toggleDesconto){
            $("#tdDesconto").append("<input type='text' name='desconto' id='desconto' style='width:50px;'>");
            toggleDesconto = false;
        }else{
            $("#desconto").remove();
            toggleDesconto = true;
        }               
    }); 
    $(".condicao").on("click",function(e){
        desconto_valor = $("#desconto").val(); 
        condi = e.target.attributes.value.value;
        valor = ($("#valor_contrato").text()).replace("R$","");
        if(desconto_valor){
            valor_contrato = valor - desconto_valor;
        }else{
            valor_contrato = valor;
        } 
        duracao = $("#valor_duracao").text(); 
        if(toggleCond){
            $("#footer").html('');
            $("#footer").append('Valor Mensal : R$ '+'<input type="text" value="'+(valor_contrato/condi).toFixed(2)+'" name="valor_final" >'+ ' X '+ condi);
            toggleCond = false;
            valor_contrato = 0;
        }else{
            $("#footer").html('');
            $("#footer").append('Valor Mensal : R$ '+'<input type="text" value="'+(valor_contrato/condi).toFixed(2)+'" name="valor_final" >'+ ' X '+ condi);
            toggleCond = true;
            valor_contrato = 0;
        }                 
    });            
});  