//Adicionar linha à tabela de itens da compra
function addItemCompra(){
    let qtdProd = $("#qtdProd").val();
    let vlUniProd = $("#vlUninProd").val();
    let produtoSelect = $("#produtoSelect").val(); 
    let descontoProd = $("#descontoProd").val();
    if(qtdProd && vlUniProd && produtoSelect){
        let itemName = $("#produtoSelect option:selected").text();
        $("#tableProducts").append(
            '<tr>'+
                '<td><input type="hidden" value="'+produtoSelect+'" name="produtos[]">'+itemName+'</td>'+
                '<td><input type="hidden" value="'+qtdProd+'" name="qtdProd[]">'+qtdProd+'</td>'+
                '<td><input type="hidden" value="'+vlUniProd+'" name="vlUniProd[]">R$'+vlUniProd+'</td>'+
                '<td><input type="hidden" value="'+descontoProd+'" name="descontoProd[]">'+descontoProd+'</td>'+ 
                '<td><button class="btn btn-sm btn-danger" onclick="removeItemCompra(this)">-</button></td>'+ 
            '</tr>'
        ); 
    } 
    resetarInputItem();
} 
//Remover linha selecionado
function removeItemCompra(data){
    $(data).parents('tr').remove();
} 
//Método para resetar os inputs de dados do itens à cada vez que é inserido uma linha na tabela
function resetarInputItem(){
    $("#qtdProd").val('');
    $("#vlUninProd").val('');
    $("#produtoSelect").val('');
    $("#descontoProd").val(''); 
} 
//Estornar a compra via AJAX e remover a linha da tabela
function estornarCompraById(data,id){
    $(data).parents('tr').remove();
    $.get( "/estoque/compra/"+id+"/delete", function( data ) {
    });
}