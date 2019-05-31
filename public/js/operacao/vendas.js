$(document).ready(function() {   
    let lastProductValue;
    let valueTotal;
    let memoryBeforeDesconto;
    let memoryDesconto;
    let contador;  
    initCampos();
    setValueTotal(0);
    setContador(0);
    carregarSelectClientes();
    carregarSelectProdutos();
    addProductOnTable();
    listenDesconto();
});
//Área de Getters e Setters
function getContador(){
    return parseFloat(this.contador);
}
function setContador(valor){
    this.contador = valor;
}
function getLastProductValue(){
    return parseFloat(this.lastProductValue);
}
function setLastProductValue(valor){
    this.lastProductValue = valor;
}
function getValueTotal(){
    return parseFloat(this.valueTotal);
}
function setValueTotal(valor){
    this.valueTotal = valor;
}
function getmemoryBeforeDesconto(){
    return parseFloat(this.memoryBeforeDesconto);
}
function setmemoryBeforeDesconto(valor){
    this.memoryBeforeDesconto = valor;
}
function getMemoryDesconto(){
    return parseFloat(this.memoryDesconto);
}
function getDate(){
    return (now.getDate() +"/"+ (now.getMonth()+1) +"/"+ now.getFullYear());
} 
function setMemoryDesconto(valor){
    this.memoryDesconto = valor;
}
//Validar campos no onsubmit e impedir submit da venda sem dados
function validarCamposOnSubmit(hasCliente){
    $("#formVenda").submit(function(e) {
        linhasTable = $('#produtos tr').length;
        vl = $("#vlTotal").val();
        if(hasCliente) {
            cli = $("#nomesClientes").val();                      
        }else{
            cli = $("#nomesClientes option:selected").val();                    
        }
        if(!cli || !vl || linhasTable<=0){
            console.log('Informações obrigatórias pendente!');
            return false;
        }
    });

}
//Zerar campos no back
function initCampos(){
    $("#nomeCliente").val('');
    $("#nomeProduto").val('');
    $("#desconto").val('');
    $("#vlTotal").val('');
}
//Adicionar produto selecionado na tabela de produtos
function addProductOnTable(){
    $('#add_prod').on("click",function(e) {
        var texto = $("#nomesProdutos option:selected").text(); 
        valorSelected  = $("#nomesProdutos option:selected").data("valor"); 
        setLastProductValue(valorSelected); 
        setContador(getContador() + valorSelected);
        var itemSelecionado = $("#nomesProdutos option:selected").val();
        $('#produtos').append('<tr class="table-primary">'+
                                '<td>R$ '+valorSelected+'</td>'+
                                '<td><input type="hidden" name="prods[]" value="'+itemSelecionado+'">'+texto+'</td>'+
                                '<td><input type="button" class="btn-danger excluir" id="excluir" value="x" onclick="remover(this,'+valorSelected+')"></td>'+
        '</tr>');
        setValueTotal(getValueTotal() + getLastProductValue());
        setmemoryBeforeDesconto(getValueTotal());
        $("#vlTotal").val(getValueTotal());
        $("#desconto").prop("disabled", false);
    });
}
//Remover options quando campo de pesquisa esta vázio
function limparSelectClient(){
    $('#nomesClientes option').each(function() {
        $(this).remove();
    });
}
//Remover options quando campo de pesquisa esta vázio
function limparSelectProduct(){
    $('#nomesProdutos option').each(function() {
        $(this).remove();
    });
}
//Adicionar options em select de acordo ao pesquisado pelo user
function carregarSelectClientes(){ 
    var textInput = document.getElementById('nomeCliente');
    // Init a timeout variable to be used below
    var timeout = null;
    // Listen for keystroke events
    nomeCliente.onkeyup = function (e) {
        //Se nome estiver vazio desabilitar campo pesquisa de produtos
        if (nomeCliente == '') {
            $("#nomeProduto").prop("disabled", true);    
            return false;                                    
        }
        //Habilitar campo de pesquisa para produtos
        $("#nomeProduto").prop("disabled", false);
            // Clear the timeout if it has already been set.
            // This will prevent the previous task from executing
            // if it has been less than <MILLISECONDS>
        clearTimeout(timeout);
            // Make a new timeout set to go off in 800ms
        timeout = setTimeout(function () {
            limparSelectClient();         
            $.get("/vendas/searchClientByName/"+textInput.value, function(data){
                for (i = 0; i < data.length; i++) {                   
                    $("#nomesClientes").append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                }
            });
        }, 500);                
    };
}
//Adicionar options em select de acordo ao pesquisado pelo user        
function carregarSelectProdutos(){
    var textInput = document.getElementById('nomeProduto');
    var timeout = null;
    nomeProduto.onkeyup = function (e) {
        //Se pesquisa de produtos ficar vazia não consumir pesquisa
        if (nomeProduto == '') {
            $("#add_prod").prop("disabled", true); 
            return false;                                    
        }
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            limparSelectProduct();         
            $.get("/vendas/searchProdByName/"+textInput.value, function(data){
                $("#add_prod").prop("disabled", false);    
                for (i = 0; i < data.length; i++) {                   
                    $("#nomesProdutos").append('<option value="'+data[i].id+'" data-valor="'+data[i].value+'">'+data[i].name+'</option>');
                }
            });
        }, 500);
    };
}         
//Remover linhas da tabela de produtos
function remover(data, valor){
    $(data).parents('tr').remove();            
    valorTotalNow = $('#vlTotal').val();
    setValueTotal(valorTotalNow - valor);
    setContador(getContador() - valor);
    //Caso produtos removidos somarem negativo tudo é zerado
    if(getValueTotal() < 0){
        setValueTotal(0);
        setmemoryBeforeDesconto(0);
        setLastProductValue(0);
        setContador(0);
    }
    $("#vlTotal").val(getValueTotal());
}         
//Listen Desconto
function listenDesconto(){ 
    var desconto = document.getElementById('desconto');
    var timeout = null;
    desconto.onkeyup = function (e) {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            if(!desconto.value == ''){
                if((getContador() - desconto.value) < 0){
                    alert('Valor desconto impossível');
                    setMemoryDesconto(0);
                    setValueTotal(getmemoryBeforeDesconto());                            
                }else{
                    setMemoryDesconto(desconto.value); 
                    setValueTotal(getContador() - getMemoryDesconto());  
                    $("#vlTotal").val(getValueTotal()); 
                }
            }else{
                $("#vlTotal").val(getContador()); 
                setMemoryDesconto(0);    
                setValueTotal(getContador());                    
            }   
            setmemoryBeforeDesconto(getmemoryBeforeDesconto());
        }, 500);
    };
}