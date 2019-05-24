@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                @if($i==0) 
                    <div class="card-header">
                        <h5>Parcelas por Período</h5> 
                    </div>
                    <div class="card-body"> 
                        <form action="/relatorios/parcelas/search" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 col-md-4">Selecione o período</div>
                                <div class="col-sm-3 col-md-3"><input type="text" id="dateStart" name="dateStart" class="form-control form-control-sm"></div>
                                <div class="col-sm-2 col-md-1">até</div> 
                                <div class="col-sm-3 col-md-3"><input type="text" id="dateEnd" name="dateEnd" class="form-control form-control-sm"></div> 
                            </div>  
                            <div class="row" style="text-align: right; padding-top: 20px">
                                <div class="col-sm-9 col-md-8">Pesquisar Por Data: 
                                </div>
                                <div class="col-sm-3 col-md-3"  style="text-align: left;">
                                    <select class="form-control form-control-sm" name="filterDate">
                                        <option value="1">de Vencimento</option>
                                        <option value="2">de Pagamento</option>
                                        <option value="3">de Faturamento</option>
                                    </select>
                                </div> 
                            </div> 
                            <div class="row" style="text-align: right; padding-top: 20px">
                                <div class="col-sm-9 col-md-8">Situação: 
                                </div>
                                <div class="col-sm-3 col-md-3"  style="text-align: left;">
                                    <select class="form-control form-control-sm" name="filterSit">
                                        <option></option>
                                        <option value="1">Pago</option>
                                        <option value="2">em Aberto</option> 
                                    </select>
                                </div> 
                            </div> 
                            <div class="row" style="text-align: right; padding-top: 20px">
                                <div class="col-sm-9 col-md-8">Plano:</div>
                                <div class="col-sm-3 col-md-3"  style="text-align: left;">
                                    <select class="form-control form-control-sm" name="filterPlan">
                                        <option></option>
                                        @if(isset($planos))
                                            @foreach($planos as $p)
                                                <option value="{{$p->id}}">{{$p->name}}</option>
                                            @endforeach 
                                        @endif
                                    </select>
                                </div> 
                            </div> 
                    </div>
                    <div class="card-footer">
                            <button class="btn btn-sm btn-info" type="submit">Pesquisar</button>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        Dados de parcelas < <a href="/relatorios/parcelas">Voltar</a>
                    </div>
                    <div class="card-body"> 
                        @if(isset($msg))
                            <div class="alert alert-danger">{{$msg}}</div>
                        @endif
                        @if(isset($data))
                                <table class="table table-sm table-responsive table-hover" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <td>Nº Parcela</td>
                                            <td>Responsável</td> 
                                            <td>Data Faturamento</td>
                                            <td>Data Vencimento</td>
                                            <td>Data Pagamento</td>
                                            <td>Nº Contrato</td>
                                            <td>Nº Venda Avulsa</td>
                                            <td>Situação</td>
                                            <td>Valor</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        <tr>
                                            <td>{{$d->id}}</td>
                                            <td>{{$d->nome_cliente}}</td>
                                            <td>{{$d->dt_fat}}</td>
                                            <td>{{$d->dt_vencimento}}</td>
                                            <td>{{$d->dt_pagamento}}</td>
                                            <td>{{$d->venda_id}}</td>
                                            <td>{{$d->venda_avulsa_id}}</td>
                                            <td>{{$d->status}}</td>
                                            <td>R${{$d->value}}</td>
                                        </tr>     
                                    @endforeach
                                    </tbody>
                                </table>
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