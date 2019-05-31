$(document).ready(function() { 
    //Evento quando o select para plano é alterado
    $("#selectPlan").change(function(){
        //montar a linha de duração
        exibirDetalhesPlano(this.value);
    }); 
});  
//Ao selecionar o plano, os detalhes(durações e modalidades) são consultados e inseridos na tela 
function exibirDetalhesPlano(plan_id){
    //Se id não estiver definido
    if (plan_id==0 || !plan_id) {
        $("#durPlan").html('');
        $("#modalsPlan").html('');                
        return false;  
    }
    //Requisição AJAX retornando dados do plano seleciondo
    $.get("/cadastros/plans/"+plan_id+"/details", function(data){
        obj = JSON.parse(data);
        $("#durPlan").html('');                
        $("#modalsPlan").html('');     
        //para cada obj vindo no array duracao           
        $.each(obj["duracoes"], function(i,item){
            $("#durPlan").append(
                '<tr>'+
                    '<td>'+
                        '<input type="radio" value="'+item+'" name="duracao">'+item+
                    '</td>'+
                '</tr>');
        });
        //para cada obj vindo no array modal
        for(i=0; i<obj["modals"].length ; i++){  
            $.each(obj["modals"][i],function(name,value){ 
                //Inclusão das modalidades que o plano possui
                $("#modalsPlan").append(
                    '<tr>'+
                        '<td>'+
                            '<input type="checkbox" value="'+obj["modals"][i]['modal_id']+'" name="modals[]">'+name+
                        '</td>'+
                        '<td>'+
                            'R$'+value+
                        '</td>'+
                    '</tr>'
                ); 
                //Se a modalidade possuir turmas, mostrar botão para exibir modal de exibir os horários
                if(obj["modals"][i]['has_turma']){ 
                    $("#modalsPlan").append('<button onclick="selecionarHorarios('+obj["modals"][i]['modal_id']+')" class="btn btn-primary btn-sm" type="button">Escolher horários</button><br>');
                } 
                return false;
            }); 
        } 
    }); 
}       
//Exibir modal de acordo ao id da modalidade
function selecionarHorarios(modal_id){

    $("#modalHorarios"+modal_id).modal('show');  
}   
//Controlar quantidade que será exibida quando clicar no checkbox selecionado
function horarioSelecionado(data,vagas,item_id){ 
    if(data.checked){
        $(data).closest('td').html('<input type="checkbox" checked name="itens_turmas[]" value="'+item_id+'" onclick="horarioSelecionado(this,'+vagas+','+item_id+')">'+(vagas-1)); 
    }else{
        $(data).closest('td').html('<input type="checkbox" name="itens_turmas[]" value="'+item_id+'" onclick="horarioSelecionado(this,'+vagas+','+item_id+')">'+(vagas)); 
    } 
} 