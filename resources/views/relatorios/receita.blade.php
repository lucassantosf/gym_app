@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                @if($i==0) 
                    <div class="card-header">
                        <h5>Receita por Período</h5> 
                    </div>
                    <div class="card-body"> 
                        <form action="/relatorios/receita/search" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 col-md-4">Selecione o período</div>
                                <div class="col-sm-3 col-md-3"><input type="text" id="dateStart" name="dateStart" class="form-control form-control-sm"></div>
                                <div class="col-sm-2 col-md-1">até</div> 
                                <div class="col-sm-3 col-md-3"><input type="text" id="dateEnd" name="dateEnd" class="form-control form-control-sm"></div> 
                            </div>  
                            <div class="row" style="text-align: right; padding-top: 20px">
                                <div class="col-sm-7 col-md-7">Forma de Pagamento: 
                                </div>
                                <div class="col-sm-5 col-md-4">
                                    <label for="checkbox">Dinheiro</label>
                                    <input type="checkbox" id="checkDin" name="checkDin" value="1">
                                </div> 
                            </div> 
                            <div class="row" style="text-align: right;">
                                <div class="col-sm-7 col-md-7"> 
                                </div>
                                <div class="col-sm-5 col-md-4">
                                    <label for="checkbox">Cartão de Crédito</label>
                                    <input type="checkbox" id="checkCC" name="checkCC" value="1">
                                </div> 
                            </div>
                            <div class="row" style="text-align: right;">
                                <div class="col-sm-7 col-md-7"> 
                                </div>
                                <div class="col-sm-5 col-md-4">
                                    <label for="checkbox">Cartão de Débito</label>
                                    <input type="checkbox" id="checkCD" name="checkCD" value="1">
                                </div> 
                            </div>
                            <div class="row" style="text-align: right;">
                                <div class="col-sm-7 col-md-7"> 
                                </div>
                                <div class="col-sm-5 col-md-4">
                                    <label for="checkbox">Cheque</label>
                                    <input type="checkbox" id="checkCh" name="checkCh" value="1">
                                </div> 
                            </div>
                            <div class="row" style="text-align: right;">
                                <div class="col-sm-7 col-md-7"> 
                                </div>
                                <div class="col-sm-5 col-md-4">
                                    <label for="checkbox">Transferência</label>
                                    <input type="checkbox" id="checkT" name="checkT" value="1">
                                </div> 
                            </div>   
                    </div>
                    <div class="card-footer">
                            <button class="btn btn-sm btn-info" type="submit">Pesquisar</button>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        Dados de receita < <a href="/relatorios/receita">Voltar</a>
                    </div>
                    <div class="card-body">
                        @if(isset($msg))
                            <div class="alert alert-danger">{{$msg}}</div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <!-- Contabilizar forma de pagamento-->
                                    @php
                                        $tot = 0;
                                        $totDin = 0;
                                        $totCC = 0;
                                        $totCD = 0;
                                        $totCh = 0;
                                        $totTr = 0;
                                        if(isset($data)){
                                            foreach($data[0] as $d){
                                                $tot += $d->valorRecibo;
                                                if($d->formaPagamento == 'dinheiro'){
                                                    $totDin += $d->valorRecibo;
                                                }
                                                if($d->formaPagamento == 'transferencia'){
                                                    $totTr += $d->valorRecibo;
                                                }
                                                if($d->formaPagamento == 'cartaoc'){
                                                    $totCC += $d->valorRecibo;
                                                }
                                                if($d->formaPagamento == 'cartaod'){
                                                    $totCD += $d->valorRecibo;
                                                }
                                                if($d->formaPagamento == 'cheque'){
                                                    $totCh += $d->valorRecibo;
                                                }
                                            }
                                        }                                                 
                                    @endphp
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr><th colspan="2" style="text-align: center;">Totalizador por Forma Pagamento</th></tr>
                                            <tr>
                                                <th>Dinheiro</th>
                                                <th>R${{$totDin}}</th>
                                            </tr>
                                            <tr>
                                                <th>Cartão Crédito</th>
                                                <th>R${{$totCC}}</th>
                                            </tr>
                                            <tr>
                                                <th>Cartão Débito</th>
                                                <th>R${{$totCD}}</th>
                                            </tr>
                                            <tr>
                                                <th>Cheque</th>
                                                <th>R${{$totCh}}</th>
                                            </tr>
                                            <tr>
                                                <th>Transferencia</th>
                                                <th>R${{$totTr}}</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: right">Total</th>
                                                <th>R${{$tot}}</th>
                                            </tr>
                                        </tbody> 
                                    </table> 
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <table class="table table-hover">
                                        <tbody> 
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Forma de Pagamento</th>
                                                    <th>Valor</th>
                                                    <th>Data de Negociação</th>
                                                    <th>Responsável</th>
                                                </tr>
                                            </thead> 
                                            @if(isset($data))
                                                @foreach($data[0] as $d)
                                                    <tr>
                                                        <td>{{$d->id}}</td>
                                                        <td>{{$d->formaPagamento}}</td> 
                                                        <td>R${{$d->valorRecibo}}</td>
                                                        <td>{{$d->dt_neg}}</td>
                                                        @if(isset($clientes))
                                                            @foreach($clientes as $c)
                                                                @if($c->id == $d->cliente_id)
                                                                    <td>{{$c->name}}</td>
                                                                @endif 
                                                            @endforeach
                                                        @endif
                                                    </tr> 
                                                @endforeach
                                            @endif 
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
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
        //InitFunctions
        $(document).ready(function() {                
            
            $('#dateStart,#dateEnd').datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
            }); 

        }); 
    </script>
@endsection