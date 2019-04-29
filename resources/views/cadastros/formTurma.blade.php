@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Listagem de Turmas -->
        @if($i==0) 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Turmas
                        <a style="float: right" href="/cadastros/formTurma" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Modalidade</th> 
                                    <th scope="col" colspan="2">Situação</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($turmas as $t) 
                                    <tr>
                                        <th>{{$t->id}}</th>
                                        <td>{{$t->name}}</td>
                                        <td>
                                            @foreach($modalidades as $m)
                                                @if($t->modal_id == $m->id)
                                                    {{$m->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($t->status == 1) Ativo 
                                            @else Inativo 
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/cadastros/turmas/{{$t->id}}/edit" class="btn btn-sm btn-info">Editar</a>
                                            <a href="/cadastros/turmas/{{$t->id}}/delete" class="btn btn-sm  btn-danger">Apagar</a>
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>
        @endif
        <!-- Cadastro de Turmas -->
        @if($i==1)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="text-align: center">Cadastrar Turmas < <a href="/cadastros/turmas">Voltar</a></div>
                    <div class="card-body">                         
                        <form action="/cadastros/formTurma" method="POST"> 
                            @csrf
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Descrição da turma</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control-plaintext" id="descricao_turma" name="descricao_turma"  placeholder="Descricao">
                                </div>
                            </div> 
                            <div class="form-row">
                                <label class="col-sm-3">Modalidade</label>
                                @if(isset($modalidades))
                                    <div class="col-sm-9">
                                        <select class="custom-select" name="modal_id">
                                            <option selected>Selecionar a modalidade</option> 
                                            @foreach($modalidades as $m)                                    
                                                <option value="{{$m->id}}">{{$m->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif 
                            </div> <br>
                            <div class="form-row">
                                <label class="col-sm-2">Ativo</label> 
                                <div class="col-sm-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="A">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <label>Adicionar horário</label>
                                    <button type="button" class="btn btn-info" onclick="incluirLinhaHora(this)">+</button>
                                </div>
                            </div>
                            <br>
                            <table class="table table-striped" id="table_horarios">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Hora Inicio</th>
                                        <th style="text-align: center">Hora Fim</th>
                                        <th style="text-align: center">Vagas</th> 
                                        <th style="text-align: center">Dia</th> 
                                        <th style="text-align: center">#</th> 
                                    </tr>
                                </thead> 
                            </table> 
                    </div>                 
                    <div class="card-footer">
                        <button class="btn btn-sm btn-info" type="submit">Salvar</button>
                        <a href="/cadastros/turmas" class="btn btn-sm btn-danger">Cancelar</a>
                        </form>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif     
                    </div>
                </div>            
            </div>
        @endif
        <!-- Edição de Turmas -->
        @if($i==2)
            @if(isset($turma))
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="text-align: center">
                            Cadastrar Turmas < <a href="/cadastros/turmas">Voltar</a>
                        </div>
                        <div class="card-body">                   
                            <form action="/cadastros/turmas/{{$turma->id}}/edit" method="POST"> 
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Descrição da turma</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control-plaintext" id="descricao_turma_edit" name="descricao_turma_edit"  value="{{$turma->name}}">
                                    </div>
                                </div> 
                                <div class="form-row">
                                    <label class="col-sm-3">Modalidade</label>
                                    @if(isset($modalidades))
                                        <div class="col-sm-9">
                                            <select class="custom-select" name="modal_id_edit">
                                                @foreach($modalidades as $m)                                    
                                                    <option value="{{$m->id}}" @if($m->id == $turma->modal_id) selected @endif >{{$m->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif 
                                </div> <br>
                                <div class="form-row">
                                    <label class="col-sm-2">Ativo</label> 
                                    <div class="col-sm-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="status" name="status_edit" value="A" @if($turma->status == 1) checked @endif>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <label>Adicionar horário</label>
                                        <button type="button" class="btn btn-info" onclick="incluirLinhaHora(this)">+</button>
                                    </div>
                                </div>
                                <br>
                                <table class="table table-striped" id="table_horarios">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Hora Inicio</th>
                                            <th style="text-align: center">Hora Fim</th>
                                            <th style="text-align: center">Vagas</th> 
                                            <th style="text-align: center">Dia</th> 
                                            <th style="text-align: center">#</th> 
                                        </tr>
                                    </thead> 
                                    @if(isset($itens_turma))
                                        <tbody>
                                            @foreach($itens_turma as $i)
                                                <tr>
                                                    <input type="hidden" name="lista1[]" value="{{$i->id}}">
                                                    <td><input type="text" class="form-control horarioInputInicio" name="horarioInicio_edit[]" value="{{$i->hora_inicio}}"></td>
                                                    <td><input type="text" class="form-control horarioInputFim" name="horarioFim_edit[]" value="{{$i->hora_fim}}"></td>
                                                    <td><input type="text" class="form-control qtdTurma" name="qtdTurma_edit[]" value="{{$i->capacidade}}"></td>
                                                    <td>
                                                        <select class="custom-select" name="diaSemana_edit[]"> 
                                                            <option value="0" @if($i->dia_semana==0) selected @endif>Domingo</option>
                                                            <option value="1" @if($i->dia_semana==1) selected @endif>Segunda-feira</option>
                                                            <option value="2" @if($i->dia_semana==2) selected @endif>Terça-feira</option>
                                                            <option value="3" @if($i->dia_semana==3) selected @endif>Quarta-feira</option>
                                                            <option value="4" @if($i->dia_semana==4) selected @endif>Quinta-feira</option>
                                                            <option value="5" @if($i->dia_semana==5) selected @endif>Sexta-feira</option>
                                                            <option value="6" @if($i->dia_semana==6) selected @endif>Sábado</option> 
                                                        </select>  
                                                    </td>
                                                    <td><button class="btn btn-danger" onclick="apagarLinhaHora(this)">-</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>                         
                        </div>                 
                        <div class="card-footer">
                            <button class="btn btn-sm btn-info" type="submit">Salvar</button>
                            </form>
                            <a href="/cadastros/turmas/{{$turma->id}}/delete" class="btn btn-sm  btn-danger">Apagar</a>
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif     
                        </div>
                    </div>            
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
 
@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script type="text/javascript">
        $(document).ready(function() { 
            incluirMascara(); 
        });

        function apagarLinhaHora(data){
            $(data).parents('tr').remove();   
        }

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

        function incluirMascara(){
            $(".horarioInput").mask('00:00', {reverse: true});  
            $(".horarioInputInicio").mask('00:00', {reverse: true});  
            $(".horarioInputFim").mask('00:00', {reverse: true});  
            $(".qtdTurma").mask('999', {reverse: true});  
        }

    </script>    
@endsection
