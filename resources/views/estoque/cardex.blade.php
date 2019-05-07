 @extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <!-- Inicio card listagem -->
        <div class="col-md-12"> 
            <div class="card"> 
                <div class="card-header" style="text-align: center">
                    Cardex
                </div>
                <div class="card-body">
                	<div class="form-group row"> 
						    <label for="dt_inicio">Periodo</label>
						    <div class="col-sm-2">
						    	<input type="text" class="form-control form-control-sm datepicker" id="dt_inicio"> 
						    </div> 
						    <label for="dt_fim">a</label> 
						    <div class="col-sm-2">
						    	<input type="text" class="form-control form-control-sm datepicker" id="dt_fim">
						    </div>  
                	</div>
                    <div class="form-group row">
                        <label for="dt_inicio">Selecione o produto</label> 
                        <div class="col-sm-3">
                            <select class="form-control form-control-sm" name="prods" id="prods">
                                <option selected></option>
                                @foreach($produtos as $p)
                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach                                      
                            </select>   
                        </div> 
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-primary btn-sm" onclick="getSearch()">Consultar</button>
                        </div> 
                    </div> 
                    <table class="table table-responsive-sm table-striped table-borderless table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Data Operação</th> 
                                <th scope="col">Operação</th> 
                                <th scope="col">Entrada</th> 
                                <th scope="col">Saida</th> 
                                <th scope="col">Saldo Anterior</th> 
                                <th scope="col">Saldo Atual</th> 
                            </tr> 
                        </thead> 
                        <tbody id="cardexInfos"> 
                        </tbody>
                    </table>
                </div> 
            </div>
        </div> 
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
        //Este método recebe os valores das datas e requisita os dados para API - dados de retorno inseridos na tabela
        function getSearch(){
            let prod_id = $("#prods").val();
            let dt_inicio = $("#dt_inicio").val();
            let dt_fim = $("#dt_fim").val(); 
            let date = dt_inicio.split('/'); 
            dt_inicio = `${date[2]}-${date[0]}-${date[1]}`;
            date = dt_fim.split('/');
            dt_fim = `${date[2]}-${date[0]}-${date[1]}`;  
            if(dt_inicio<dt_fim){
                $.getJSON("/estoque/cardex/"+dt_inicio+"/"+dt_fim+"/"+prod_id, function( data ) { 
                    $("#cardexInfos").html('');
                    $.each(data, function( key, val ) {
                        $("#cardexInfos").append(
                            '<tr>'+
                                '<td>'+val.created_at+'</td>'+
                                '<td>'+getOperacao(val)+'</td>'+
                                '<td>'+getValue(val.entrada)+'</td>'+
                                '<td>'+getValue(val.saida)+'</td>'+ 
                                '<td>'+val.saldo_anterior+'</td>'+
                                '<td>'+val.saldo_atual+'</td>'+ 
                            '</tr>'
                        );   
                    });                 
                });
            }else{
                alert('Valores das datas estão erradas');
            } 
        }
        //Esté método apenas retorna qual tipo de operacao foi realizada no item do cardex
        function getOperacao(data){
            if(data.balanco_id) return 'Balanço';
            if(data.compra_id) return 'Compra';
            if(data.venda_avulsa_id) return 'Venda';
        }
        //Este método retorna o valor da entrada ou saida do item cardex
        function getValue(value){
            if(value){
                return value;
            }else{
                return '';
            }
        } 
    </script>
@endsection