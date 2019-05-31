$(document).ready(function() {    
    $("#dt_born").mask('00/00/0000', {reverse: true});
    $("#cpf").mask('000.000.000-00', {reverse: true});
    $("#rg").mask('00.000.000-0', {reverse: true});
    $("#phone").mask('(00)0 0000-0000', {reverse: true});
    $("#cep").mask('00000-000', {reverse: true});
});

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
        }//end if.
            else {
                //CEP pesquisado não foi encontrado.
                $("#cep").val('');
                alert("CEP não encontrado.");
            }
        });
    }else{
        alert('Cep em branco!');
    }
}