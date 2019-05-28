@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">  
                    <div class="form-group row">  
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="txtBusca" placeholder="Buscar pelo nome"/>
                        </div> 
                    </div>
                    Total de {{$clients->total()}} clientes
                </div> 
                <div class="card-body" id="ulItens">
                    <ul class="list-group">
                    @if(isset($clients))
                        @foreach($clients as $c)
                            <li class="list-group-item"><a href="/clients/{{$c->id}}/show" class="link">{{$c->name}}</a> - {{$c->situaçao}}</li> 
                        @endforeach
                    @endif
                    </ul>
                </div> 
                <div class="card-footer" style="text-align: center">
                    {{$clients->links()}}
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection 
@section('javascript')
    <script type="text/javascript" src="jquery-2.0.2.min.js">
    <script type="text/javascript" src="jquery.hideseek.min.js">
    <script type="text/javascript">
        $(function(){
            $("#txtBusca").focus(); 
            $("#txtBusca").keyup(function(){
                var texto = $(this).val();
                $("#ulItens li").show();
                $("#ulItens li").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) $(this).hide(); 
                });
            });
        });    
    </script>
@endsection