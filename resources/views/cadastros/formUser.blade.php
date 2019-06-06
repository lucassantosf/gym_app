@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cadastrar Usuários < <a href="/cadastros/users">Voltar</a></div>
                <div class="card-body">
                @if(isset($user))
                    <form action="/cadastros/user/{{$user->id}}/edit" method="POST" id="formUser">
                        @csrf
                       <label>Nome:</label>                        
                            <input type="text" class="form-control" placeholder="Nome" name="name" id="name" value="{{$user->name}}">
                            <label>Email:</label>                
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{$user->email}}">
                            <label>Senha:</label>                      
                            <input type="password" class="form-control" placeholder="Password" name="password_new" id="password_new" value="e99a18c428cb38d5f260853678922e03" >
                            <label>Confirmar Senha:</label>                        
                            <input type="password" class="form-control" placeholder="Password Confirm" name="password_confirm_new"  value="e99a18c428cb38d5f260853678922e03" id="password_confirm_new"><br>
                @else                
                    <form action="/cadastros/formUser" method="POST" id="formUser">
                        @csrf
                       <label>Nome:</label>                        
                        <input type="text" class="form-control" placeholder="Nome" name="name" id="name" value="{{@old('name')}}">
                        <label>Email:</label>                
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{@old('email')}}">
                        <label>Senha:</label>                      
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <label>Confirmar Senha:</label>                        
                        <input type="password" class="form-control" placeholder="Password Confirm" name="password_confirm" id="password_confirm"><br>
                </div>
                @endif
                <div class="card-footer">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif     
                    @if(isset($user))
                        <button class="btn btn-sm btn-info" type="submit">Editar</button>
                        <a href="/cadastros/users" class="btn btn-sm btn-secondary">Cancelar</a> 
                        <a href="/cadastros/user/{{$user->id}}/delete" class="btn btn-sm btn-danger">Excluir</a>
                    @else                
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                    @endif
                    </form>
                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/cadastros/formUser.js')}}"></script> 
@endsection 