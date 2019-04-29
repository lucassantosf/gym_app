@extends('layouts.app')

@section('content')
<div class="container" id="containerMain">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            	<div class="card-header" style="text-align: center">
          			Gestão de turmas
            	</div>
            	<div class="card-body">
            		<div class="form-group row" style="padding-bottom: 10px">
					    <label class="col-sm-2 col-form-label"></label>
					    <label class="col-sm-3 col-form-label">Modalidade</label>
					    @if(isset($modalidades))
						    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm" id="selectModal">
							  		<option value="0">...</option> 
								  	@foreach($modalidades as $m)
								  		<option value="{{$m->id}}">{{$m->name}}</option> 
								  	@endforeach
							</select>
						@endif
					</div>            		
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label"></label>
					    <label class="col-sm-3 col-form-label">Turma</label>
					    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm" id="selectTurma"> 
						</select> 
					</div>
					<table class="table table-sm table-responsive-sm table-borderless table-striped table-hover" style="font-size: 5" >
						<thead>
						    <tr> 
							    <th>Cod</th>
							    <th>Hora Inicio</th>
							    <th>Hora Fim</th>
							    <th>Ocupação</th>
							    <th>Dom</th>
							    <th>Seg</th>
							    <th>Ter</th>
							    <th>Qua</th>
							    <th>Qui</th>
							    <th>Sex</th>
							    <th>Sáb</th>
						    </tr>
						</thead>
						<tbody id="table_details_turma"> 
						</tbody>
					</table>
            	</div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('javascript')
    <script type="text/javascript">
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
    </script>
@endsection