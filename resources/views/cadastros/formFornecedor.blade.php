@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i == 0)        
            <!-- Inicio card listagem -->
            <div class="col-md-12"> 
                <div class="card"> 
                    <div class="card-header">Fornecedores
                        <a style="float: right" href="/cadastros/formFornecedor" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" colspan="2">Situação</th>
                                </tr> 
                              </thead> 
                              <tbody> 
                                    @if(isset($forns))
                                    @foreach($forns as $f)
                                        <tr>
                                            <td>{{$f->id}}</td>
                                            <td>{{$f->name}}</td>
                                            <td>{{$f->email}}</td>
                                            <td>@if( $f->status == 1) Ativo @else Inativo @endif</td> 
                                            <td>
                                                <a href="/cadastros/fornecedor/{{$f->id}}/edit" class="btn btn-info btn-sm">Editar</a>
                                                <a href="/cadastros/fornecedor/{{$f->id}}/delete"  class="btn btn-danger btn-sm">Apagar</a>
                                            </td> 
                                        </tr> 
                                    @endforeach
                                    @endif
                              </tbody>
                        </table>
                    </div> 
                </div>
            </div>
            <!-- Fim card listagem --> 
        @endif     
        @if($i == 1)
            <!-- Inicio card Cadastro-->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Cadastrar fornecedor</div>
                    <div class="card-body">  
                        <form action="/cadastros/formFornecedor" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control"> 
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
        @if($i=2)
            @if(isset($fornecedor))
                @foreach($fornecedor as $f)
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">Editar fornecedor</div>
                            <div class="card-body">  
                                <form action="/cadastros/fornecedor/{{$f->id}}/edit" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nome</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" value="{{$f->name}}" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" class="form-control" value="{{$f->email}}"> 
                                    </div>
                                </div>          
                                <div class="form-group row">
                                    <div class="col-sm-3">Ativo
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="status" name="status" value="A" @if($f->status == 1) checked @endif>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary">Editar</button> 
                                <a href="/cadastros/fornecedores" class="btn btn-sm btn-danger">Cancelar</a>
                                </form>                    
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif 
    </div>
</div>
@endsection 
@section('javascript')  
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script> 
@endsection