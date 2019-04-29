@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header input-group input-group-md mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Listagem de Clientes</span>
                    </div>
                    <input type="text" class="form-control" id="txtBusca" placeholder="Buscar..."/>

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

            </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')
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
