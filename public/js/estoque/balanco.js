//Método para DOM quando estiver carregado
$(document).ready(function() {   
    setItens(); 
});

let cod_prod = new Array();
let qtd_prod = new Array();
let obj = new Object(); 

//Getter from obj
function getObj(){ 

    return obj;
} 
//Retornar o saldo de um prod de acordo ao prod_id
function getLastSaldo(prod_id){ 
    obj = getObj(); 
    for(i=0; i< obj.produto_id.length ; i++){  
        if(obj.produto_id[i] == prod_id){ 
            return obj.qtd_prod[i]; 
        }  
    }
} 
//Apenas calcular diferença para entre saldo e quantidade atual do balanço 
function getDifference(qtdProd,lastSaldo){ 

    return (lastSaldo - qtdProd);
} 
//Adicionar linha à tabela de itens da compra
function addItemBalanco(){
    let qtdProd = $("#qtdProd").val(); 
    let produtoSelect = $("#produtoSelect").val();  
    let descontoProd = $("#descontoProd").val();  
    let itemName = $("#produtoSelect option:selected").text();
    $("#tableProducts").append(
        '<tr>'+
            '<td><input type="hidden" value="'+produtoSelect+'" name="prods_id[]"><input type="hidden" value="'+itemName+'" name="prods_name[]">'+itemName+'</td>'+
            '<td><input type="hidden" value="'+qtdProd+'" name="qtdProd[]">'+qtdProd+'</td>'+ 
            '<td><input type="hidden" value="'+getLastSaldo(produtoSelect)+'" name="lastSaldo[]">'+ 
                getLastSaldo(produtoSelect)+
            '</td>'+
            '<td><input type="hidden" value="'+getDifference(getLastSaldo(produtoSelect),qtdProd)+'" name="diffence[]">'+
                getDifference(getLastSaldo(produtoSelect),qtdProd)+
            '</td>'+
            '<td><button class="btn btn-sm btn-danger" onclick="removeItemBalanco(this)">-</button></td>'+  
        '</tr>'
    );  
    resetarInputItem();
} 
//Remover linha selecionada
function removeItemBalanco(data){

    $(data).parents('tr').remove();
} 
//Método para resetar os inputs de dados do itens à cada vez que é inserido uma linha na tabela
function resetarInputItem(){
    $("#qtdProd").val(''); 
    $("#produtoSelect").val('');  
} 
//Estornar a compra via AJAX e remover a linha da tabela
function estornarCompraById(data,id){
    $(data).parents('tr').remove();
    $.get( "/estoque/compra/"+id+"/delete", function( data ) {
    });
}