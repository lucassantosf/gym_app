@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i == 0)        
            <!-- Inicio card listagem -->
            <div class="col-md-12"> 
                <div class="card"> 
                    <div class="card-header">Produtos e Serviços
                        <a style="float: right" href="/cadastros/formProd" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col" colspan="2">Situação</th>
                                </tr>
                              </thead> 
                              <tbody> 
                                    @foreach($prods as $p)
                                    <tr>
                                        <th scope="row">{{$p->id}}</th>
                                        <td>{{$p->name}}</td>
                                        <td>{{$p->value}}</td>
                                        <td>@if($p->status == 1) Ativo @else Inativo @endif</td>
                                        <td>
                                            <a href="/cadastros/prod/{{$p->id}}/edit" class="btn btn-sm btn-info">Editar</a>
                                            <a href="/cadastros/prod/{{$p->id}}/delete" class="btn btn-sm btn-danger">Excluir</a>         
                                        </td>
                                    </tr> 
                                    @endforeach
                              </tbody>
                        </table>
                    </div> 
                </div>
            </div>
            <!-- Fim card listagem -->
        @else
            <!-- Inicio card Cadastro-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastrar produtos e serviços</div>
                    <div class="card-body"> 
                        @if(!isset($prod))          
                            <form action="/cadastros/formProd" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nome</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" placeholder="Descrição"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Valor</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="value" class="form-control" placeholder="R$"> 
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-sm-3">Controla Estoque
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="controlEstoque" name="controlEstoque" value="1">
                                        </div>
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
                        @else
                                <form action="/cadastros/prod/{{$prod->id}}/edit" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nome</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" value="{{$prod->name}}"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Valor</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="value" class="form-control" value="{{$prod->value}}"> 
                                    </div>
                                </div>    
                                <div class="form-group row">
                                    <div class="col-sm-3">Controla Estoque
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="controlEstoque" name="controlEstoque" value="1" @if($prod->controlEstoque == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>                    
                                <div class="form-group row">
                                    <div class="col-sm-3">Ativo
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="status" name="status" value="A" @if($prod->status == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                        @endif 
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button> 
                        <a href="/cadastros/products" class="btn btn-sm btn-danger">Cancelar</a>
                        </form>                    
                    </div>
                </div>
            </div>
            <!-- Fim card Cadastro-->
        @endif    
    </div>
</div>
@endsection
