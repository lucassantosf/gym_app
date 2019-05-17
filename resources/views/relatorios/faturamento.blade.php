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
                        @if(isset($data)) 
                            @if(isset($data[0]))
                                @foreach($data[0] as $d)
                                    @if(isset($clientes))
                                        @foreach($clientes as $c)
                                            @if($c->id == $d->cliente_id)
                                            <h4>{{$c->name}}</h4>
                                            @endif
                                        @endforeach
                                    @endif
                                    <small class="form-text text-muted">
                                        {{$d->plano_name}} - {{$d->duracao}} - {{$d->value_total}}
                                    </small>     
                                @endforeach
                            @endif
                            @if(isset($data[1])) 
                                {{var_dump($data[1])}} 
                            @endif
                        @endif
                        @if(isset($msg))
                            <div class="alert alert-danger">
                                {{$msg}}
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