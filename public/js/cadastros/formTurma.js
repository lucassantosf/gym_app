$(document).ready(function() { 
    incluirMascara(); 
});
//Remover linhas do grid formTurma
function apagarLinhaHora(data){
    $(data).parents('tr').remove();   
}
//Adicionar linha do grid formTurma
function incluirLinhaHora(data){
    $('#table_horarios').append('<tr>'+
        '<td><input type="text" class="form-control horarioInput" name="horarioInicio[]"></td>'+
        '<td><input type="text" class="form-control horarioInput" name="horarioFim[]"></td>'+ 
        '<td><input type="text" class="form-control qtdTurma" name="qtdTurma[]"></td>'+
        '<td>'+
            '<select class="custom-select" name="diaSemana[]">'+
                //'<option selected>Selecione o dia</option>'+ 
                '<option value="0">Domingo</option>' +
                '<option value="1">Segunda-feira</option>' +
                '<option value="2">Terça-feira</option>' +
                '<option value="3">Quarta-feira</option>' +
                '<option value="4">Quinta-feira</option>' +
                '<option value="5">Sexta-feira</option>' +
                '<option value="6">Sábado</option>' +
            '</select>'+
        '</td>'+  
        '<td><button class="btn btn-danger" onclick="apagarLinhaHora(this)">-</button></td>'+
        '</tr>');
    incluirMascara(); 
}
//Mascara para os campos de horarios
function incluirMascara(){
    $(".horarioInput").mask('00:00', {reverse: true});  
    $(".horarioInputInicio").mask('00:00', {reverse: true});  
    $(".horarioInputFim").mask('00:00', {reverse: true});  
    $(".qtdTurma").mask('999', {reverse: true});  
}