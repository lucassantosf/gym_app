//InitFunctions
$(document).ready(function() {                
    mascaraCampos();
    //Se for ativo mostrar progressBar duracao do contrato
    progressBarDuracao(); 
}); 
//Esta função paga uma parcela diretamente pelo profile e no final busca o recibo que acabou de ser gerado
function pagarParcela(id,hasContrato,hasVenda){
    if(hasContrato) {
        $.get("/clients/pagarParcela/"+id+"/"+hasContrato);
    }else{
        $.get("/clients/pagarParcelaVA/"+id+"/"+hasVenda);
    }
    $("#"+id).remove();
    $(".parcela"+id).html('<span class="border border-1 border-info rounded">Pago</span>');
    //contabiliza quantas linhas tem na tabela de recibos - se não tiver retira a mensagem de 'Sem recibos'
    let qtdLinhas = $('#historicoPagamento tr').length ;
    if(qtdLinhas >= 2) {   $('.firtRecibo').remove();  }
    this.getRecibo(id);
}  
//Esta função busca o recibo de acordo ao parcela_id - utilizado logo ao pagar a parcela de forma avulsa pelo perfil do aluno - inclui uma linha ta tabela historicoPagamento
function getRecibo(parcela_id){
    $.getJSON("/clients/getRecibo/"+parcela_id, function(data){
        $("#historicoPagamento").append(
            '<tr>'+
                '<td style="text-align: center">'+data.id+'</td>'+
                '<td style="text-align: center">'+data.formaPagamento+'</td>'+
                '<td style="text-align: center" class="linhaRecibo'+data.id+'">R$'+data.valorRecibo+'</td>'+
                '<td style="text-align: center">'+'<button class="btn badge badge-pill badge-danger" onclick="estornarRecibo(this,'+data.id+')">Estornar</button>'+
                '</td>'+
            '</tr>');
    });
} 
//Esta função define a mascara dos campos na edição de dados pessoais
function mascaraCampos(){
    $("#dt_born").mask('00/00/0000', {reverse: true});
    $("#cpf").mask('000.000.000-00', {reverse: true});
    $("#rg").mask('00.000.000-0', {reverse: true});
    $("#phone").mask('(00)0 0000-0000', {reverse: true});
    $("#cep").mask('00000-000', {reverse: true});
} 
//Esta função é utilizada para consultar CEP
function consultar(){
    cep = $('#cep').val();
    cep = cep.replace('-','');
    if(cep.length < 8) return false;
    if (cep != "" || cep.length >= 8) {
        $.getJSON("https://viacep.com.br/ws/"+cep+"/json/?callback=?", function(dados) {
        if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $("#address").val(dados.logradouro);
            $("#compl").val(dados.complemento);
            $("#neigh").val(dados.bairro);
            $("#city").val(dados.localidade);
            $("#country").val('Brasil');
            $("#uf").val(dados.uf);
        }else {
            //CEP pesquisado não foi encontrado.
            $("#cep").val('');
            alert("CEP não encontrado.");
            }
        });
    }else{
        alert('Cep em branco!');
    }
} 
//Esta função estorna o recibo de acordo ao seu id - e altera tabela parcelas_historico - parcela volta a ficar em aberto
function estornarRecibo(data,id){
    $.getJSON("/clients/estornarRecibo/"+id,function(data){
        $.each(data,function(index,value){
            $('.parcela'+value.id).html('');
            $('.parcela'+value.id).html('<a class="border border-1 border-info rounded" id="'+value.id+'" onclick="pagarParcela('+value.id+','+value.venda_id+','+value.venda_avulsa_id+')">Em aberto</a>');
        });                
    });
    $(data).parents('tr').remove(); 
    let qtdLinhas = $('#historicoCompras td').length ; 
    if(qtdLinhas == 0) {
        $('#historicoCompras').append('<tr><td class="firtRecibo" colspan="4" style="text-align: center">Nenhum pagamento realizado</td></tr>');
    }
} 
//Esta função estorna a venda_avulsa que o item clicado esta relacionado
function estornarItemVendaAvulsa(data,id_item,id_venda){
    apagar = confirm("Confirmar estornar venda "+id_venda+" ? Todos produtos e recibos serão excluidos!");
    if(apagar){
        $('.linhaVenda'+id_venda).parents('tr').remove();
        $.getJSON("/vendas/estornarVendaAvulsa/"+id_venda,function(data){ 
            $('.parcela'+data[0]).parents('tr').remove();
            $('.linhaRecibo'+data[1]).parents('tr').remove(); 
            for(i = 2; i < data.length; i++){
                ///console.log(data[i]);
                $.each( data[i], function( key, value ) { 
                    $('.parcela'+data[i]['id']).html('');
                    $('.parcela'+data[i]['id']).html('<a class="border border-1 border-info rounded" id="'+data[i]['id']+'" onclick="pagarParcela('+data[i]['id']+','+data[i]['venda_id']+','+data[i]['venda_avulsa_id']+')">Em aberto</a>');
                });                        
            } 
        }); 
        //Contabilizador de colunas do historicoCompras
        let qtdLinhas = $('#historicoPagamento tr').length ;
        if(qtdLinhas >= 2) {   $('.firtRecibo').remove();  }
    } 
    //Contabilizador de colunas do historicoCompras
    let qtdLinhas = $('#historicoCompras td').length ; 
    if(qtdLinhas == 0) {
        $('#historicoCompras').append('<tr><td colspan="3" style="text-align: center">Nenhuma venda realizada</td></tr>');
    }
}