$(document).ready(function() { 
    incluirMascara();
    /*  CONTINUAR AQUI
    $("#formTurma,#formTurmaEdit").submit(function(e) {   
        let submit = checkEmptFields();
        console.log(submit);
        if(!submit) {return false;}
        //
    });*/
}); 
function checkEmptFields(){
    let descricao_turma = $("#descricao_turma,#descricao_turma_edit").val();
    let modal_id = $("#modal_id").val();  
    let table_horarios = $("#table_horarios tr").length; 
    if(!descricao_turma) { alert('Descricao da turma esta vazio'); return false;}
    if(isNaN(modal_id)) { alert('Selecione alguma modalidade'); return false;}
    if(table_horarios<=1) { 
        alert('Inserir algum horário');
        return false;
    }else{
        let horarioInicio = $("input[name='horarioInicio[]']");
        horarioInicio.each(function() {
            var value = $(this).val();   
            if(!value){
                alert('Não tem horário inicio');
                return false;
            }
        });
        let horarioFim = $("input[name='horarioFim[]']");
        horarioFim.each(function() {
            var value = $(this).val();   
            if(!value){
                alert('Não tem horário fim');
                return false;
            }
        });
        let qtdTurma = $("input[name='qtdTurma[]']");
        qtdTurma.each(function() {
            var value = $(this).val();   
            if(!value){
                alert('Informar quantidade');
                return false;
            }
        }); 

    } 
    
} 
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