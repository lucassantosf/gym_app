@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i == 0)        
            <!-- Inicio card listagem -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Modalidades
                        <a style="float: right" href="/cadastros/formModal" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Valor Mensal</th>
                                    <th scope="col">Frequencia</th>
                                    <th scope="col">Turma</th>
                                    <th scope="col" colspan="2">Situação</th> 
                                </tr>
                              </thead>
                              <tbody> 
                                    @foreach($modals as $m)
                                    <tr onclick="location.href= '/cadastros/modal/{{$m->id}}/edit';">
                                        <th scope="row">{{$m->id}}</th>
                                        <td>{{$m->name}}</td>
                                        <td>R${{$m->value}}</td>
                                        <td>{{$m->freq}}</td>
                                        <td>@if($m->controlTurma == 1) Sim @else Não @endif</td>
                                        <td>@if($m->status == 1) Ativo @else Inativo @endif</td> 
                                    </tr> 
                                    @endforeach
                              </tbody>
                        </table>
                    </div> 
                </div>
            </div>
            <!-- Fim card listagem-->
        @endif
        @if($i == 1)
            <!-- Inicio card Cadastro-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastrar modalidade < <a href="/cadastros/modals">Voltar</a></div>
                    <div class="card-body">
                        @if(!isset($modal)) 
                        <form action="/cadastros/formModal" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nome</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" placeholder="Descrição" value="{{old('name')}}"> 
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Valor mensal</label>
                                <div class="col-sm-8">
                                    <input type="text" name="value" class="form-control" placeholder="R$" value="{{old('value')}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Frequencia</label>
                                <div class="col-sm-4">
                                    <input type="text" name="freq" class="form-control" placeholder="Dias na semana" value="{{old('freq')}}"> 
                                </div>                            
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">Ativo
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="A">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">Controla Turma
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="turma" name="turma" value="T">
                                    </div>
                                </div>
                            </div>
                            @else
                            <form action="/cadastros/modal/{{$modal->id}}/edit" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nome</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" value="{{$modal->name}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Valor mensal</label>
                                <div class="col-sm-8">
                                    <input type="text" name="value" class="form-control" value="{{$modal->value}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Frequencia</label>
                                <div class="col-sm-4">
                                    <input type="text" name="freq" class="form-control" value="{{$modal->freq}}"> 
                                </div>                            
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">Ativo
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="A" @if($modal->status == 1) checked  @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">Controla Turma
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="turma" name="turma" value="T" @if($modal->controlTurma == 1) checked  @endif>
                                    </div>
                                </div>
                            </div> 
                            @endif 
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{$error}}</div>
                                @endforeach
                            @endif   
                    </div>
                    <div class="card-footer">
                        @if(!isset($modal))<button type="submit" class="btn btn-sm btn-primary">Salvar</button>@else<button type="submit" class="btn btn-sm btn-primary">Editar</button> 
                        @endif
                        <a href="/cadastros/modals" class="btn btn-sm btn-secondary">Cancelar</a>@if(isset($modal))
                        <a href="/cadastros/modal/{{$modal->id}}/delete" class="btn btn-sm btn-danger">Excluir</a>@endif
                        </form>                    
                    </div>
                </div>
            </div>
            <!-- Fim card Cadastro-->
        @endif  
    </div>
</div>
@endsection
@section('javascript')   
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script> 
@endsection 