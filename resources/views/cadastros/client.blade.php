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
                <div class="card-body ulItens" id="cardBody">
                    <ul class="list-group" id="list1">
                    @if(isset($clients))
                        @foreach($clients as $c)
                        <li class="list-group-item"><a href="/clients/{{$c->id}}/show" class="link">{{$c->name}}</a> - {{$c->situaçao}}</li> 
                        @endforeach
                    @endif
                    </ul> 
                </div> 
                <div class="card-footer component_pag" style="text-align: center">
                    {{$clients->links()}}
                </div>
                <ul class="list-group ulItens" id="list2" style="display: none;">
                    @if(isset($clients2))
                        @foreach($clients2 as $c)
                    <li class="list-group-item"><a href="/clients/{{$c->id}}/show" class="link">{{$c->name}}</a> - {{$c->situaçao}}</li> 
                        @endforeach
                    @endif
                </ul>   
            </div> 
        </div>
    </div>
</div>
@endsection 
@section('javascript') 
    <script type="text/javascript" src="{{asset('js/components/filter_list_clients.js')}}"> 
    </script> 
@endsection