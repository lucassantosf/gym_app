//Função de inicialização ao carregar DOM
$(document).ready(function() {   
	//Evento ao alterar modalidade
	$("#selectModal").change(function() {
	  	buscarTurmaFromModalId();
	});
		//Evento ao seleionar alguma turma
		$("#selectTurma").change(function() {
	  	buscarItensFromTurmaId();
	});
});   
//Este método inclui as turmas da modalidade selecionada pelo selectModal
function buscarTurmaFromModalId(){ 
	$("#selectTurma").html('');
	$("#table_details_turma").html('');  
	$("#selectTurma").append('<option></option>');
	let modal_id = $('#selectModal').val(); 
	//Requisição pelas turmas da modalidade
	$.getJSON("/home/turmas/gestaoturmasview/consultarTurmasFromModalId/"+modal_id, function(data){
	    $.each(data, function(i, field){
	      	$("#selectTurma").append('<option value="'+field.id+'">'+field.name+'</option'); 
	    });
	});
}
//Este método consulta a grade horária de uma determinada turma e exibe na tela
function buscarItensFromTurmaId(){
	let turma_id = $('#selectTurma').val(); 
	$.getJSON("/home/turmas/gestaoturmasview/consultarItensFromTurmaId/"+turma_id, function(data){
	    $("#table_details_turma").html('');  
	    //Para cada item data[0] insere uma linha na table_details_turma 
	    $.each(data[0], function(i, field){ 
	    	let taxa_ocupacao = ((field.capacidade - field.vagas_livres)*100)/field.capacidade; 
	      	$("#table_details_turma").append(
	      		'<tr>'+
	      			'<td>'+field.id+'</td>'+  
	      			'<td>'+field.hora_inicio+'</td>'+  
	      			'<td>'+field.hora_fim+'</td>'+  
	      			'<td>'+parseFloat(taxa_ocupacao.toFixed(1))+'%</td>'+  
	      			'<td>'+getCapacidade(0,field.dia_semana,field.vagas_livres,field.id)+'</td>'+  
	      			'<td>'+getCapacidade(1,field.dia_semana,field.vagas_livres,field.id)+'</td>'+  
	      			'<td>'+getCapacidade(2,field.dia_semana,field.vagas_livres,field.id)+'</td>'+  
	      			'<td>'+getCapacidade(3,field.dia_semana,field.vagas_livres,field.id)+'</td>'+  
	      			'<td>'+getCapacidade(4,field.dia_semana,field.vagas_livres,field.id)+'</td>'+  
	      			'<td>'+getCapacidade(5,field.dia_semana,field.vagas_livres,field.id)+'</td>'+  
	      			'<td>'+getCapacidade(6,field.dia_semana,field.vagas_livres,field.id)+'</td>'+   
	      		'</tr>'
	      	); 
	      	//Inserir modal dos alunos matriculados para exibir pela função openModal()
	      	$('#containerMain').append( 
	    		'<div class="modal fade" id="modalDetailsItem'+field.id+'">'+
					'<div class="modal-dialog modal-dialog-centered">'+
					    '<div class="modal-content">'+
						    '<div class="modal-header">'+
						        '<h5 class="modal-title" style="text-align:center;">Alunos matriculados</h5>'+
						        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
						          	'<span aria-hidden="true">&times;</span>'+
						        '</button>'+
						    '</div>'+
						    '<div class="modal-body" id="modalDetailsItem'+field.id+'Content">'+ 
						    '</div>'+
					    '</div>'+
					'</div>'+
				'</div>'
			);
	    });
	    //Para cada item data[1] inserir os alunos matriculados na respectiva modal
	    $.each(data[1], function(i, field){			    	
	    	$.each(field, function(f, value){ 
	      		$('#modalDetailsItem'+value.item_turma_id+'Content').append('Nome : '+value.name_cliente+'<br>');
	    	});
	    });
	});
} 
//Evento para abrir modal de acordo ao item_turma
function openModal(item_id){ 

	$('#modalDetailsItem'+item_id).modal();
}
//Este método auxilia a exibição da grade horária na dia correto
function getCapacidade(dia_array,field,vagas_livres,item_id){
	if (dia_array==field) {
		return '<a onclick="openModal('+item_id+')">'+vagas_livres+'</a>';
	}else{
		return '';
	} 
}