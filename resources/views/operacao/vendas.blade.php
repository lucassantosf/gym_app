@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card"> 
                    <div class="card-header">Realizar Venda</div>
                    <div class="card-body"> 
                        <form action="/vendas/viewPost" method="POST" id="formVenda">@csrf
                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <label for="dataNeg">Data Venda</label>
                            </div>
                            <div class="col-sm-3 col-md-3"> 
                                <input class="form-control form-control-sm" type="text" class="datapicker" id="dataNeg" name="dataNeg">
                            </div> 
                        </div> 
                    @if(isset($cliente_id)) 
                        <input type="hidden" class="form-control" id="nomesClientes" name="nomesClientes" value="{{$cliente_id}}">
                        <h2><a href="/clients/{{$cliente_id}}/show" class="badge badge-info" id="nomeCliente" name="nomeCliente">{{$cliente_name}}</a></h2> 
                    @else   <br>
                        <div class="input-group input-group-sm mb-12">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="spanCliente">Escolha um cliente</span>
                            </div>
                            <input type="text" class="form-control" id="nomeCliente" name="nomeCliente">
                            <select class="form-control" id="nomesClientes" name="nomesClientes">    
                                    <!-- Incluir nomes pesquisados -->     
                            </select>
                        </div> <br>
                    @endif   
                        <div class="input-group input-group-sm mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanProduto">Escolher produtos</span>
                            </div>
                            <input type="text" class="form-control" id="nomeProduto" @if(!isset($cliente_id)) disabled @endif>
                            <select class="form-control" id="nomesProdutos" name="produto">
                                <!-- Produtos incluidos ao ser pesquisado -->
                            </select>
                            <input type="button" id="add_prod" class="btn btn-primary btn-sm" value="+" disabled>
                        </div> 
                        <table class="table table-hover" id="produtos">                              
                            <!-- Produtos incluido dinamicamente -->  
                        </table>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanDesconto">Desconto</span>
                            </div>
                            <input type="text" class="form-control" id="desconto" name="desconto" disabled>
                        </div>
                        <hr>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanVlTotal">Valor Total</span>
                            </div>
                            <input type="text" class="form-control" id="vlTotal" name="vlTotal">
                        </div>
                </div> 
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm" type="submit" @if(isset($cliente_id)) onclick="validarCamposOnSubmit(true)" @else onclick="validarCamposOnSubmit(false)" @endif >Confirmar Venda</button>     
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection
@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script type="text/javascript" src="{{asset('js/components/datepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/util/date.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/operacao/vendas.js')}}"></script>
@endsection