//Este método recebe os valores das datas e requisita os dados para API - dados de retorno inseridos na tabela
function getSearch(){
    let prod_id = $("#prods").val();
    let dt_inicio = $("#dt_inicio").val();
    let dt_fim = $("#dt_fim").val(); 
    let date = dt_inicio.split('/'); 
    dt_inicio = `${date[2]}-${date[1]}-${date[0]}`;
    date = dt_fim.split('/');
    dt_fim = `${date[2]}-${date[1]}-${date[0]}`;  
    if(dt_inicio<dt_fim){
        $.getJSON("/estoque/cardex/"+dt_inicio+"/"+dt_fim+"/"+prod_id, function( data ) { 
            $("#cardexInfos").html('');
            $.each(data, function( key, val ) {
                $("#cardexInfos").append(
                    '<tr>'+
                        '<td>'+val.created_at+'</td>'+
                        '<td>'+getOperacao(val)+'</td>'+
                        '<td>'+getValue(val.entrada)+'</td>'+
                        '<td>'+getValue(val.saida)+'</td>'+ 
                        '<td>'+val.saldo_anterior+'</td>'+
                        '<td>'+val.saldo_atual+'</td>'+ 
                    '</tr>'
                );   
            });                 
        });
    }else{
        alert('Valores das datas estão erradas');
    } 
}
//Esté método apenas retorna qual tipo de operacao foi realizada no item do cardex
function getOperacao(data){
    if(data.balanco_id) return 'Balanço';
    if(data.compra_id) return 'Compra';
    if(data.venda_avulsa_id) return 'Venda';
}
//Este método retorna o valor da entrada ou saida do item cardex
function getValue(value){
    if(value){
        return value;
    }else{
        return '';
    }
} 