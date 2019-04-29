@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="text-align:center">Negociação de Contrato</div>
                <form action="/cadastros/plans/postConferirNeg" method="POST">
                @csrf
                <div class="card-body">
                    <fieldset disabled>
                            <div class="form-row">@if(isset($client))
                            <label class="form-control center" for="id_cliente" style="text-align:center; margin: 0 auto;">{{$client->name}}</label>
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            </div>
                    </fieldset>
                    <input type="hidden" name="id_cliente" id="id_cliente" value="{{$client->id}}">@endif
                    <br>    
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Plano" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                    <div class="form-row">     
                        <select class="custom-select" name="selectPlan" id="selectPlan">
                            <option selected value="0">Selecionar...</option>
                            @foreach($plans as $p)
                                <option value="{{$p->id}}">{{$p->name}}</option>                
                            @endforeach            
                        </select> 
                    </div><br>
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Duração" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                      
                    <!-- Incluir duracoes dos planos via jquery-->
                    <div class="table-responsive">
                        <table class="table" id="durPlan"> 
                        </table>
                    </div>
                     
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Modalidades" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                    
                    <!-- Incluir modalidades nos planos via jquery-->                        
                    <div class="table-responsive">
                        <table class="table" id="modalsPlan"> 
                        </table>
                    </div>

                    <!-- Modal para os horários de turmas-->
                    @if(isset($modals))
                        @foreach($modals as $m)
                            <div class="modal fade bd-example-modal-lg" aria-hidden="true" id="modalHorarios{{$m->id}}" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th colspan="10" style="text-align: center">Grade horária de {{$m->name}}</th> 
                                                    </tr>
                                                    <tr>
                                                        <th>Id Turma</th>
                                                        <th>Hora Inicio</th>
                                                        <th>Hora Fim</th>
                                                        <th>Dom</th>
                                                        <th>Seg</th>
                                                        <th>Ter</th>
                                                        <th>Qua</th>
                                                        <th>Qui</th>
                                                        <th>Sex</th>
                                                        <th>Sab</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($itens as $i)
                                                        @if($i->modal_id == $m->id)
                                                            <tr>
                                                                <td>{{$i->id}}</td>
                                                                <td>{{$i->hora_inicio}}</td>
                                                                <td>{{$i->hora_fim}}</td>
                                                                <td>
                                                                    @if($i->dia_semana == 0) 
                                                                        <input type="checkbox" name="itens_turmas[]" value="{{$i->id}}" onclick="horarioSelecionado(this,{{$i->vagas_livres}},{{$i->id}})">{{$i->vagas_livres}} 
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($i->dia_semana == 1) 
                                                                        <input type="checkbox" name="itens_turmas[]" value="{{$i->id}}" onclick="horarioSelecionado(this,{{$i->vagas_livres}},{{$i->id}})">{{$i->vagas_livres}} 
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($i->dia_semana == 2) 
                                                                        <input type="checkbox" name="itens_turmas[]" value="{{$i->id}}" onclick="horarioSelecionado(this,{{$i->vagas_livres}},{{$i->id}})">{{$i->vagas_livres}} 
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($i->dia_semana == 3) 
                                                                        <input type="checkbox" name="itens_turmas[]" value="{{$i->id}}" onclick="horarioSelecionado(this,{{$i->vagas_livres}},{{$i->id}})">{{$i->vagas_livres}} 
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($i->dia_semana == 4) 
                                                                        <input type="checkbox" name="itens_turmas[]" value="{{$i->id}}" onclick="horarioSelecionado(this,{{$i->vagas_livres}},{{$i->id}})">{{$i->vagas_livres}} 
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($i->dia_semana == 5) 
                                                                        <input type="checkbox" name="itens_turmas[]" value="{{$i->id}}" onclick="horarioSelecionado(this,{{$i->vagas_livres}},{{$i->id}})">{{$i->vagas_livres}} 
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($i->dia_semana == 6) 
                                                                        <input type="checkbox" name="itens_turmas[]" value="{{$i->id}}" onclick="horarioSelecionado(this,{{$i->vagas_livres}},{{$i->id}})">{{$i->vagas_livres}} 
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Conferir negociação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
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
    </script>
@endsection