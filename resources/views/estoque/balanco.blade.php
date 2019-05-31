@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i == 0)        
            <!-- Inicio card listagem -->
            <div class="col-md-10"> 
                <div class="card"> 
                    <div class="card-header">
                        Balanços Realizadas
                        <a style="float: right" href="/estoque/formBalanco" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Cód. Balanço</th> 
                                    <th scope="col">Realizado em</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                @if(isset($balancos))
                                    @foreach($balancos as $b)
                                        <tr>
                                            <td>{{$b->id}}</td>
                                            <td>{{$b->dt_balanco}}</td>
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
                    <div class="card-header" style="text-align: center">
                        Lançar Balanço
                    </div>
                    <div class="card-body">  
                        <form action="/estoque/formBalanco" method="POST">
                            @csrf        
                            <div class="form-group row">
                                <label class="col-sm-2">Data Balanço</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-sm datepicker" id="dt_emissao" name="dt_emissao"> 
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
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-sm btn-info" onclick="addItemBalanco()">+</button> 
                                </div>
                            </div> 
                            <div class="row">
                                <table class="table table-responsive-sm table-striped">
                                        <thead>
                                            <tr>
                                              <th>Produto</th>
                                              <th>Quantidade no Balanço</th>
                                              <th>Saldo Anterior</th>
                                              <th>Diferença</th>
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
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </div>
</div>
@endsection 
@section('javascript') 
    <script type="text/javascript" src="{{asset('js/components/datepicker.js')}}"> 
    </script>
    <script type="text/javascript">
        //Método para DOM quando estiver carregado
        $(document).ready(function() {   
            setItens(); 
        });

        let cod_prod = new Array();
        let qtd_prod = new Array();
        let obj = new Object();

        //Setar obj com os arrays dos prods e qtd_prods
        function setItens(){
            //Se não houver nenhum registro de posição de estoque para os produtos gerar array qtd zerado 
            @if(count($posicao_atual) == 0)
                @foreach($produtos as $p)
                    cod_prod.push({{$p->id}});
                    qtd_prod.push(0); 
                @endforeach 
            @else
                //Se houver registros, inserir dados no array
                @foreach($posicao_atual as $p)
                    cod_prod.push({{$p['produto_id']}});
                    qtd_prod.push({{$p['quantidade_atual']}});  
                @endforeach  
            @endif
            //Setar obj
            obj.produto_id = cod_prod;
            obj.qtd_prod = qtd_prod;
        }

        //Getter from obj
        function getObj(){ 

            return obj;
        } 
        //Retornar o saldo de um prod de acordo ao prod_id
        function getLastSaldo(prod_id){ 
            obj = getObj(); 
            for(i=0; i< obj.produto_id.length ; i++){  
                if(obj.produto_id[i] == prod_id){ 
                    return obj.qtd_prod[i]; 
                }  
            }
        } 
        //Apenas calcular diferença para entre saldo e quantidade atual do balanço 
        function getDifference(qtdProd,lastSaldo){ 

            return (lastSaldo - qtdProd);
        } 
        //Adicionar linha à tabela de itens da compra
        function addItemBalanco(){
            let qtdProd = $("#qtdProd").val(); 
            let produtoSelect = $("#produtoSelect").val();  
            let descontoProd = $("#descontoProd").val();  
            let itemName = $("#produtoSelect option:selected").text();
            $("#tableProducts").append(
                '<tr>'+
                    '<td><input type="hidden" value="'+produtoSelect+'" name="prods_id[]"><input type="hidden" value="'+itemName+'" name="prods_name[]">'+itemName+'</td>'+
                    '<td><input type="hidden" value="'+qtdProd+'" name="qtdProd[]">'+qtdProd+'</td>'+ 
                    '<td><input type="hidden" value="'+getLastSaldo(produtoSelect)+'" name="lastSaldo[]">'+ 
                        getLastSaldo(produtoSelect)+
                    '</td>'+
                    '<td><input type="hidden" value="'+getDifference(getLastSaldo(produtoSelect),qtdProd)+'" name="diffence[]">'+
                        getDifference(getLastSaldo(produtoSelect),qtdProd)+
                    '</td>'+
                    '<td><button class="btn btn-sm btn-danger" onclick="removeItemBalanco(this)">-</button></td>'+  
                '</tr>'
            );  
            resetarInputItem();
        } 
        //Remover linha selecionada
        function removeItemBalanco(data){

            $(data).parents('tr').remove();
        } 
        //Método para resetar os inputs de dados do itens à cada vez que é inserido uma linha na tabela
        function resetarInputItem(){
            $("#qtdProd").val(''); 
            $("#produtoSelect").val('');  
        } 
        //Estornar a compra via AJAX e remover a linha da tabela
        function estornarCompraById(data,id){
            $(data).parents('tr').remove();
            $.get( "/estoque/compra/"+id+"/delete", function( data ) {
            });
        }
    </script>
@endsection