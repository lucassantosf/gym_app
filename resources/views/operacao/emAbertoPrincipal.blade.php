@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">Caixa em Aberto 
                    < <a href="/home" class="link">Voltar</a>
                </div>
                
                <div class="card-body">                    
                    <div class="input-group input-group-sm mb-3">
                      <input type="text" class="form-control" placeholder="Nome do cliente" id="nomeCliente">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" onclick="buscarParcelas()">Buscar Parcelas</button>
                        <button class="btn btn-dark btn-sm" onclick="limparCampos()">Limpar Campo</button>
                      </div>
                    </div>
                    <form action="/clients/caixaAberto/pagarParcela" method="POST">
                        @csrf
                        <div id="parcelasCliente">
                        </div>
                        <div id="total"><!-- Incluir valor total -->                        
                        </div>                    
                </div>
                <div class="card-footer"> 
                    <button type="submit" class="btn btn-sm btn-primary">Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('js/operacao/emAbertoPrincipal.js')}}"></script>
@endsection