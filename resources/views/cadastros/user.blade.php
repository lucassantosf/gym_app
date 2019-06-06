@extends('layouts.app') 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <!-- Listagem de usuários do sistema-->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Usuários do sistema
          <a style="float: right" class="btn btn-outline-info btn-sm" href="/cadastros/formUser">Cadastrar</a>
        </div>
        <div class="card-body">
            @if (isset($users))
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
                  @foreach($users as $u)
                      <tr onclick="location.href = '/cadastros/user/{{$u->id}}/edit';">
                        <th>{{$u->id}}</th>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>@Ativo</td> 
                      </tr>                                
                  @endforeach                            
                </tbody>
              </table>
            @else
              <p>Não há usuários cadastrados em sua base de dados</p>
            @endif
        </div> 
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')   
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script> 
@endsection 