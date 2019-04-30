@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i == 0)        
            <!-- Inicio card listagem -->
            <div class="col-md-12"> 
                <div class="card"> 
                    <div class="card-header">Compras Realizadas
                        <a style="float: right" href="/estoque/formCompra" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Cód. Compra</th>
                                    <th scope="col">Nº Nota Fiscal</th>
                                    <th scope="col">Emitido em</th>
                                    <th scope="col" colspan="2">Comprado em</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                @if(isset($compras))
                                    @foreach($compras as $c)
                                        <tr>
                                            <td>{{$c->id}}</td>
                                            <td>{{$c->nota_fiscal}}</td>
                                            <td>{{$c->dt_emissao}}</td>
                                            <td>{{$c->dt_compra}}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="estornarCompraById(this,{{$c->id}})">
                                                  Estornar <span class="badge badge-light">X</span>
                                                </button>
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
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Lançar Compra</div>
                    <div class="card-body">  
                        <form action="/estoque/formCompra" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2">Fornecedor</label>
                                <div class="col-sm-6">
                                    <select class="custom-select custom-select-sm" name="fornecedorSelect" id="fornecedorSelect">
                                        <option selected></option> 
                                        @if(isset($fornecedores))
                                            @foreach($fornecedores as $f)
                                                <option value="{{$f->id}}">{{$f->name}}</option> 
                                            @endforeach
                                        @endif 
                                    </select>                                     
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Nº Nota Fiscal</label>
                                <div class="col-sm-5">
                                    <input type="text" name="numNF" id="numNF" class="form-control form-control-sm"> 
                                </div>
                            </div>          
                            <div class="form-group row">
                                <label class="col-sm-2">Data Emissão</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-sm datepicker" id="dt_emissao" name="dt_emissao"> 
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2">Data Compra</label>
                                <div class="col-sm-2">
                                    <input type="text"  class="form-control form-control-sm datepicker" id="dt_compra" name="dt_compra"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Produtos</label>
                                <div class="col-sm-7">
                                    <select class="custom-select custom-select-sm" name="produtoSelect" id="produtoSelect">
                                        <option selected></option> 
                                        @if(isset($produtos))
                                            @foreach($produtos as $p)
                                                <option value="{{$p->id}}">{{$p->name}}</option> 
                                            @endforeach
                                        @endif 
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row"> 
                                <div class="col-sm-2">Dados</div>
                                <div class="col-sm-2">
                                    <input type="text" name="qtdProd" id="qtdProd" class="form-control form-control-sm" placeholder="Qtd">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="vlUninProd" id="vlUninProd" class="form-control form-control-sm" placeholder="Valor Unitário">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="descontoProd" id="descontoProd" class="form-control form-control-sm" placeholder="Desconto Total">
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-sm btn-info" onclick="addItemCompra()">+</button> 
                                </div>
                            </div> 
                            <div class="row">
                                <table class="table table-responsive-sm table-striped">
                                        <thead>
                                            <tr>
                                              <th>Produto</th>
                                              <th>Quantidade</th>
                                              <th>Valor Unitário</th>
                                              <th>Desconto Total</th>
                                              <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableProducts"> 
                                        </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button> 
                        <a href="/estoque/compras" class="btn btn-sm btn-danger">Cancelar</a>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        //Método para DOM quando estiver carregado
        $(document).ready(function() {  
            $( function(data) {

                //Exibir o plugin de calendário
                $( ".datepicker" ).datepicker();
            }); 
        });

        //Adicionar linha à tabela de itens da compra
        function addItemCompra(){
            let qtdProd = $("#qtdProd").val();
            let vlUniProd = $("#vlUninProd").val();
            let produtoSelect = $("#produtoSelect").val(); 
            let descontoProd = $("#descontoProd").val();
            if(qtdProd && vlUniProd && produtoSelect){
                let itemName = $("#produtoSelect option:selected").text();
                $("#tableProducts").append(
                    '<tr>'+
                        '<td><input type="hidden" value="'+produtoSelect+'" name="produtos[]">'+itemName+'</td>'+
                        '<td><input type="hidden" value="'+qtdProd+'" name="qtdProd[]">'+qtdProd+'</td>'+
                        '<td><input type="hidden" value="'+vlUniProd+'" name="vlUniProd[]">R$'+vlUniProd+'</td>'+
                        '<td><input type="hidden" value="'+descontoProd+'" name="descontoProd[]">'+descontoProd+'</td>'+ 
                        '<td><button class="btn btn-sm btn-danger" onclick="removeItemCompra(this)">-</button></td>'+ 
                    '</tr>'
                ); 
            } 
            resetarInputItem();
        }

        //Remover linha selecionado
        function removeItemCompra(data){
            $(data).parents('tr').remove();
        }

        //Método para resetar os inputs de dados do itens à cada vez que é inserido uma linha na tabela
        function resetarInputItem(){
            $("#qtdProd").val('');
            $("#vlUninProd").val('');
            $("#produtoSelect").val('');
            $("#descontoProd").val('');

        }

        //Estornar a compra via AJAX e remover a linha da tabela
        function estornarCompraById(data,id){
            $(data).parents('tr').remove();
            $.get( "/estoque/compra/"+id+"/delete", function( data ) {
            });
        }
    </script>
@endsection