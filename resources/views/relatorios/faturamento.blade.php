@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card"> 
                @if($i==0) 
                    <div class="card-header">
                        <h5>Faturamento por Período</h5> 
                    </div>
                    <div class="card-body"> 
                        <form action="/relatorios/faturamento/search" method="GET">
                            @csrf 
                            <div class="row">
                                <div class="col-sm-4 col-md-3">Selecione o período</div>
                                <div class="col-sm-3 col-md-3"><input type="text" id="dateStart" name="dateStart" class="form-control form-control-sm"></div>
                                <div class="col-sm-2 col-md-1">até</div> 
                                <div class="col-sm-3 col-md-3"><input type="text" id="dateEnd" name="dateEnd" class="form-control form-control-sm"></div> 
                            </div>  
                            <div class="row" style="text-align: right; padding-top: 20px">
                                <div class="col-sm-7 col-md-6">Incluir: 
                                </div>
                                <div class="col-sm-5 col-md-4">
                                    <label for="checkbox">Planos</label>
                                    <input type="checkbox" id="checkPlan" id="checkPlan" name="checkPlan">
                                </div> 
                            </div> 
                            <div class="row" style="text-align: right;">
                                <div class="col-sm-7 col-md-6"> 
                                </div>
                                <div class="col-sm-5 col-md-4">
                                    <label for="checkbox">Vendas Avulsas</label>
                                    <input type="checkbox" id="checkVenda" id="checkVenda" name="checkVenda">
                                </div> 
                            </div>
                    </div>
                    <div class="card-footer">
                            <button class="btn btn-sm btn-info" type="submit">Pesquisar</button>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        Dados de faturamento< <a href="/relatorios/faturamento">Voltar</a>
                    </div>
                    <div class="card-body"> 
                        @php
                            $Tot = 0;
                        @endphp
                        @if(isset($data))  
                            @if(isset($data[0])) 
                                @foreach($data[0] as $d)
                                    @if(isset($clientes))
                                        @foreach($clientes as $c)
                                            @if($c->id == $d->cliente_id)
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th colspan="5">{{$c->name}}</th> 
                                                    </tr>
                                                </thead>  
                                            @endif
                                        @endforeach
                                    @endif 
                                        @php
                                            $Tot += $d->value_total;
                                        @endphp
                                                <tbody style="font-size: 14px">
                                                    <tr>
                                                        <td>Matricula {{$c->id}}</td>
                                                        <td>{{$d->plano_name}}</td>
                                                        <td>{{$d->dt_neg}}</td>
                                                        <td>Duração {{$d->duracao}}</td>
                                                        <td>R${{$d->value_total}}</td>
                                                    </tr>
                                                </tbody> 
                                            </table>
                                @endforeach
                            @endif
                            @if(isset($data[1]))  
                                @foreach($data[1] as $da)
                                    @if(isset($clientes))
                                        @foreach($clientes as $c)
                                            @if($c->id == $da->cliente_id)
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th colspan="5">{{$c->name}}</th> 
                                                    </tr>
                                                </thead>  
                                            @endif
                                        @endforeach 
                                    @endif
                                        @php
                                            $Tot += $da->value;
                                        @endphp
                                                <tbody  style="font-size: 14px">
                                                    <tr>
                                                        <td>Venda Nº{{$da->id}}</td>
                                                        <td style="text-align: right;">{{$da->dt_neg}}</td>
                                                        <td style="text-align: right;">R${{$da->value}}</td>
                                                    </tr>
                                                    @if(isset($data[2]))
                                                        @for($i=2 ; $i < count($data) ;$i++)
                                                            @if($data[$i]->venda_avulsa_id == $da->id)
                                                            <tr>
                                                                <td>Cód Produto {{$data[$i]->produto_id}}</td>
                                                                <td style="text-align: right" colspan="2">{{$data[$i]->descricao_produto}}</td> 
                                                            </tr> 
                                                            @endif
                                                        @endfor
                                                    @endif
                                                </tbody> 
                                            </table>
                                @endforeach 
                            @endif
                        @endif
                        @if(isset($msg))
                            <div class="alert alert-danger">
                                {{$msg}}
                            </div> 
                        @endif 
                    </div>
                    <div class="card-footer"> 
                        @php
                            echo 'Valor total R$ '.$Tot;
                        @endphp
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